version="0.3.`git rev-list HEAD --count`"
name="fhq"

# remove old deb package
find ./ -name *.deb  | while read f; do  rm "$f"; done

# clear old lintian log
echo "" > "lintian.log"

rm -rf deb-pkg_create
mkdir deb-pkg_create
# cp -R source/visuallinecoding deb-pkg/usr/bin/
cp -R deb-pkg/* deb-pkg_create/

cd deb-pkg_create

find -type f | grep -re ~$ | while read f; do rm -rf "$f"; done

if [ ! -d "usr" ]; then
	mkdir "usr"  
fi

if [ ! -d "usr/bin" ]; then
	mkdir "usr/bin"  
fi

if [ ! -d "usr/share" ]; then
	mkdir "usr/share"  
fi


if [ ! -d "usr/share/doc" ]; then
	mkdir "usr/share/doc"
fi

if [ ! -d "usr/share/doc/fhq" ]; then
	mkdir "usr/share/doc/fhq"
fi

cp ../../LICENSE usr/share/doc/fhq/copyright

# php-files
mkdir usr/share/fhq
# must be uncommented:
cp -R ../../php/fhq/* usr/share/fhq/

find usr/share/fhq/ -name *~  | while read f; do  rm "$f"; done
find usr/share/fhq/ -name .gitignore  | while read f; do  rm "$f"; done

rm usr/share/fhq/api/download-yii.sh
rm usr/share/applications/fhq.desktop
rm usr/share/fhq/quests/fuzzing-50/fuzz_50

# change log
echo "$name ($version) unstable; urgency=low" > usr/share/doc/fhq/changelog.Debian
echo "" >> usr/share/doc/fhq/changelog.Debian

git log --oneline | while read line
do
	echo "  * $line " >> usr/share/doc/fhq/changelog.Debian
done
echo "" >> usr/share/doc/fhq/changelog.Debian
echo " -- Evgenii Sopov <mrseakg@gmail.com> `date --rfc-2822` " >> usr/share/doc/fhq/changelog.Debian
echo "" >> usr/share/doc/fhq/changelog.Debian

gzip -9 usr/share/doc/fhq/changelog.Debian

# todo manual
gzip -9 "usr/share/man/man1/fhq.1"
# strip --strip-unneeded --target=usr/bin/visuallinecoding

# todo for deamon attack defence
# strip -S -o usr/bin/visuallinecoding usr/bin/visuallinecoding
# strip --strip-unneeded -o usr/bin/fhq usr/bin/fhq

# help: https://www.debian.org/doc/manuals/maint-guide/dreq.ru.html

if [ ! -d "DEBIAN" ]; then
	mkdir "DEBIAN"  
fi

# config files
echo "/etc/fhq/init.conf" > DEBIAN/conffiles
echo "/etc/fhq/actions.conf" >> DEBIAN/conffiles

# control
# todo section ???

size=($(du -s ./))
size=${size[0]}
echo "Source: $name
Section: web
Priority: optional
Maintainer: Evgenii Sopov <mrseakg@gmail.com>
Depends: apache2 (>= 2.2), mysql-server (>= 5.5)
Version: $version
Installed-Size: $size
Homepage: https://github.com/sea-kg/fhq
Package: $name
Architecture: all
Description: Engine for running CTF-games
 fhq contains web module (front end)
 also daemon for attack defence
" > DEBIAN/control


# create md5sums
echo -n "" > DEBIAN/md5sums
find "." -type f | while read f; do
	md5sum "$f" >> DEBIAN/md5sums
done

find usr -type f | while read f; do  chmod 644 "$f"; done
find etc -type f | while read f; do  chmod 644 "$f"; done
find DEBIAN -type f | while read f; do  chmod 644 "$f"; done

find usr -type d | while read d; do  chmod 755 "$d"; done
find etc -type d | while read d; do  chmod 755 "$d"; done
find DEBIAN -type d | while read d; do  chmod 755 "$d"; done

# chmod 755 usr/bin/attackdefence
# chmod +x usr/share/fhq/api/framework/yiic
# chmod +x usr/share/fhq/api/framework/cli/views/webapp/protected/yiic

find usr -type f | while read f; do md5sum "$f"; done > DEBIAN/md5sums
find etc -type f | while read f; do md5sum "$f"; done >> DEBIAN/md5sums

cd ..

echo "from deb-pkg_create"

#build
fakeroot dpkg-deb --build deb-pkg_create ./

# todo uncommneted:
rm -rf deb-pkg_create

#check
lintian *.deb > lintian.log


