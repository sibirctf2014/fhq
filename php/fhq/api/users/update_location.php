<?php
header("Access-Control-Allow-Origin: *");

$curdir = dirname(__FILE__);
include_once ($curdir."/../api.lib/api.base.php");
include_once ($curdir."/../../config/config.php");

FHQHelpers::checkAuth();

$result = array(
	'result' => 'fail',
	'data' => array(),
);

$result['result'] = 'ok';

$conn = FHQHelpers::createConnection($config);

$country = '';
$city = '';

if (!FHQHelpers::issetParam('country'))
  FHQHelpers::showerror(909, 'Not found parameter "country"');

if (!FHQHelpers::issetParam('city'))
  FHQHelpers::showerror(910, 'Not found parameter "city"');
  
if (!FHQHelpers::issetParam('university'))
  FHQHelpers::showerror(915, 'Not found parameter "university"');

$country = FHQHelpers::getParam('country', '');
$city = FHQHelpers::getParam('city', '');
$university = FHQHelpers::getParam('university', '');


try {
	$_SESSION['user']['profile']['country'] = $country;
	$_SESSION['user']['profile']['city'] = $city;
	$_SESSION['user']['profile']['university'] = $university;
	
	$query = 'UPDATE users_profile SET value = ?, date_change = NOW() WHERE name = ? AND userid = ?';
	$stmt = $conn->prepare($query);

	$stmt->execute(array($country, 'country', FHQSecurity::userid()));
	$stmt->execute(array($city, 'city', FHQSecurity::userid()));
	$stmt->execute(array($university, 'university', FHQSecurity::userid()));

	$result['result'] = 'ok';
} catch(PDOException $e) {
	FHQHelpers::showerror(911, $e->getMessage());
}

echo json_encode($result);
