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

/*$errmsg = "";
if (!checkGameDates($security, &$message))
	showerror(709, 'Error 709: '.$errmsg);*/

$conn = FHQHelpers::createConnection($config);

if (FHQHelpers::issetParam('id')) {
	$game_id = FHQHelpers::getParam('id', 0);

	if (!is_numeric($game_id))
		FHQHelpers::showerror(705, 'Error 705: incorrect id');

	// try {
		$query = '
			SELECT *
			FROM
				games
			WHERE id = ?';

		$columns = array('id', 'type_game', 'title', 'date_start', 'date_stop', 'date_restart', 'description', 'logo', 'owner');

		$stmt = $conn->prepare($query);
		$stmt->execute(array(intval($game_id)));
		if($row = $stmt->fetch())
		{
			$_SESSION['game'] = array();
			$result['data'] = array();
			foreach ( $columns as $k) {
				$_SESSION['game'][$k] = $row[$k];
				$result['data'][$k] = $row[$k];
			}
			$result['result'] = 'ok';
		}
		else
		{
			FHQHelpers::showerror(702, 'Game with id='.$game_id.' are not exists');
		}

		// loading score
		$stmt2 = $conn->prepare('select * from users_games where userid= ? AND gameid = ?');
		$stmt2->execute(array(intval(FHQSecurity::userid()), intval($game_id)));
		if($row2 = $stmt2->fetch())
		{
			$_SESSION['user']['score'] = $row2['score'];
			$result['user'] = array();
			$result['user']['score'] = $row2['score'];
		}
		else
		{
			// calculate score
			$query2 = '
				SELECT 
					ifnull(SUM(quest.score),0) as sum_score 
				FROM 
					userquest 
				INNER JOIN 
					quest ON quest.idquest = userquest.idquest AND quest.id_game = ?
				WHERE 
					(userquest.iduser = ?) 
					AND ( userquest.stopdate <> \'0000-00-00 00:00:00\' );
			';
			$score = 0;
			$stmt4 = $conn->prepare($query2);
			$stmt4->execute(array(intval($game_id), FHQSecurity::userid()));
			if ($row3 = $stmt4->fetch())
				$score = $row3['sum_score'];
			
			$stmt3 = $conn->prepare('INSERT INTO users_games (userid, gameid, score, date_change) VALUES(?,?,?,NOW())');
			$stmt3->execute(array(intval(FHQSecurity::userid()), intval($game_id), intval($score)));
			
			$_SESSION['user']['score'] = $score;
			$result['user'] = array();
			$result['user']['score'] = $score;
		}	
	// } catch(PDOException $e) {
//		FHQHelpers::showerror(712, $e->getMessage());
//	}
} else {
	FHQHelpers::showerror(713, 'not found parameter id');
}

include_once ($curdir."/../api.lib/savetoken.php");
echo json_encode($result);
