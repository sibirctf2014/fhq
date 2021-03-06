<?php
class FHQUser {
	static function loadUserProfile($conn) {
		try {
			$profile = array();
			$inserts = array();
			$defaults = array();
			$defaults['template'] = 'base';
			$defaults['country'] = '?';
			$defaults['city'] = '?';
			$defaults['university'] = '?';
			$defaults['game'] = '0';

			$query = 'SELECT * FROM users_profile WHERE userid = ?';
			$stmt = $conn->prepare($query);
			$stmt->execute(array(FHQSecurity::userid()));
			while($row = $stmt->fetch()) {
				$name = $row['name'];
				$value = $row['value'];
				$profile[$name] = $value;			
			}

			foreach ( $defaults as $k => $v) {
				if (!isset($profile[$k] )) {
					$inserts[$k] = $v; // default value
					$profile[$k] = $v; // default value
				}
			}

			foreach ( $profile as $k => $v) {
				$_SESSION['user']['profile'][$k] = $v;
			}

			$stmt2 = $conn->prepare('INSERT INTO users_profile(userid,name,value,date_change) VALUES(?,?,?,NOW());');
			foreach ( $inserts as $k => $v) {
				$stmt2->execute(array(FHQSecurity::userid(), $k, $v));
			}
		} catch(PDOException $e) {
			showerror(103, 'Error 103: ' + $e->getMessage());
		}
	}
	
	static function loadUserScore($conn) {
	}
}
