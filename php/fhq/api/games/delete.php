<?php
header("Access-Control-Allow-Origin: *");

$curdir = dirname(__FILE__);
include ($curdir."/../api.lib/api.helpers.php");
include ($curdir."/../../config/config.php");
include ($curdir."/../../engine/fhq.php");

$security = new fhq_security();
checkAuth($security);

$result = array(
	'result' => 'fail',
	'data' => array(),
);

$conn = FHQHelpers::createConnection($config);

if(!$security->isAdmin())
  showerror(786, 'Error 786: access denie. you must be admin.');

if (!issetParam('id'))
  showerror(789, 'Error 789: not found parameter "id"');

if (!issetParam('captcha'))
  showerror(788, 'Error 788: not found parameter "captcha"');

$captcha = getParam('captcha', '');
$orig_captcha = $_SESSION['captcha_reg'];
$_SESSION['captcha_reg'] = md5(rand().rand());

if( strtoupper($captcha) != strtoupper($orig_captcha))
	showerror(787, 'Error 787: captcha incorrect '.$orig_captcha.'  '.$captcha);

$game_id = getParam('id', 0);

if (!is_numeric($game_id))
  showerror(785, 'Error 785: incorrect id');
		
$query = 'DELETE FROM games WHERE id = ?';

try {
 	$stmt = $conn->prepare($query);
 	$stmt->execute(array(intval($game_id)));
 	$result['result'] = 'ok';
} catch(PDOException $e) {
 	showerror(782, 'Error 782: ' + $e->getMessage());
}

echo json_encode($result);
