<?php
header("Access-Control-Allow-Origin: *");

$curdir = dirname(__FILE__);
include_once ($curdir."/../api.lib/api.base.php");
include_once ($curdir."/../api.lib/api.security.php");
include_once ($curdir."/../api.lib/api.helpers.php");
include_once ($curdir."/../../config/config.php");

include_once ($curdir."/../api.lib/loadtoken.php");

FHQHelpers::checkAuth();

$result = array(
	'result' => 'fail',
	'data' => array(),
);

if ($conn == null)
	$conn = FHQHelpers::createConnection($config);

try {
  // TODO paging
	$query = 'SELECT 
				games.id,
				games.title,
				games.type_game,
				games.date_start,
				games.date_stop,
				games.date_restart,
				games.description,
				games.logo,
				games.owner,
        games.organizators,
				user.nick
			FROM
				games
			INNER JOIN user ON games.owner = user.iduser
			ORDER BY games.date_start
			DESC LIMIT 0,10;';

	$columns = array('id', 'title', 'type_game', 'date_start', 'date_stop', 'date_restart', 'description', 'logo', 'owner', 'nick', 'organizators');

	$stmt = $conn->prepare($query);
	$stmt->execute();
	$i = 0;
	while($row = $stmt->fetch())
	{
		$id = $row['date_start'];
		$result['data'][$id] = array();
		foreach ( $columns as $k) {
			$result['data'][$id][$k] = $row[$k];
		}

		$bAllows = FHQSecurity::isAdmin();
		$result['data'][$id]['permissions']['delete'] = $bAllows;
		$result['data'][$id]['permissions']['update'] = $bAllows;
	}
	$result['current_game'] = isset($_SESSION['game']) ? $_SESSION['game']['id'] : 0;
	
	$result['permissions']['insert'] = FHQSecurity::isAdmin();
	$result['result'] = 'ok';
} catch(PDOException $e) {
	FHQHelpers::showerror(702, $e->getMessage());
}

include_once ($curdir."/../api.lib/savetoken.php");

echo json_encode($result);
