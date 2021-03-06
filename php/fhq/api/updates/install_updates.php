<?php

$curdir = dirname(__FILE__);
include_once ($curdir."/../api.lib/api.base.php");
include_once ($curdir."/../api.lib/api.game.php");
include_once ($curdir."/../api.lib/api.updates.php");
include_once ($curdir."/../../config/config.php");

FHQHelpers::checkAuth();

if (!FHQSecurity::isAdmin())
	FHQHelpers::showerror(10927, "This function allowed only for admin");

$result = array(
	'result' => 'fail',
	'data' => array(),
);

$result['result'] = 'ok';

$conn = FHQHelpers::createConnection($config);

$version = FHQUpdates::getVersion($conn);
$result['version'] = $version;

$updates = array();

$curdir = dirname(__FILE__);
$filename = $curdir.'/updates/'.$version.'.php';

while (file_exists($filename)) {
	include_once ($filename);
	$function_update = 'update_'.$version;
	if (!function_exists($function_update)) {
		$result['data'][$version] = 'Not found function '.$function_update;
		break;
	}

	if ($function_update($conn)) {
		FHQUpdates::insertUpdateInfo($conn,
			$version,
			$updates[$version]['to_version'],
			$updates[$version]['name'],
			$updates[$version]['description'],
			FHQSecurity::userid()
		);
		$result['data'][$version] = 'installed';
	} else {
		$result['data'][$version] = 'failed';
	}

	$new_version = FHQUpdates::getVersion($conn);
	if ($new_version == $version)
		break;
	$version = $new_version;
	$result['version'] = $version;
	$filename = $curdir.'/updates/'.$version.'.php';
}

echo json_encode($result);
