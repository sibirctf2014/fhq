<?

$curdir = dirname(__FILE__);

$doc = array();
include_once $curdir."/tex.php";
include_once $curdir."/auth/index.php";
include_once $curdir."/users/index.php";
include_once $curdir."/games/index.php";
include_once $curdir."/quests/index.php";
include_once $curdir."/updates/index.php";

print_doc($doc);
