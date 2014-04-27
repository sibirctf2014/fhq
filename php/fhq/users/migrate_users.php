<?
	if (!isset($config)) {
		echo "NO!!!!";
		exit;
	}
	
	$security = new fhq_security();
	if (!$security->isAdmin()) {
		echo "You are not admin!!!";
		exit;
	}
	
	$curdir = dirname(__FILE__);
	
	echo "Migrate Users from old table 'user' to table 'users' (functionality not yet completed)";
	
	
	function create_guid()   //Генераци GUID
	{  
		mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = 
            substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
	} 
	
	$db = new fhq_database();
	$query = 'SELECT * FROM user';
	$result = $db->query( $query );
	while ($row = mysql_fetch_row($result, MYSQL_ASSOC)) // Data
	{
		$mail = base64_decode($row['username']);

		$mail = '"'.mysql_real_escape_string($mail).'"';

		$query2 = "SELECT COUNT(*) as cnt FROM users where UCASE(mail) = $mail";
		$result2 = $db->query( $query2 );
		$row2 = mysql_fetch_row($result2, MYSQL_ASSOC);
		if ($row2['cnt'] == 0)  {
			echo "<pre>migrating user: <br>";

			$guid = '"'.create_guid().'"';
			
			$role = 0;
			$old_role = $row['nick'];
			if ($old_role == 'user') $role = 0;
			if ($old_role == 'admin') $role = 1;
			if ($old_role == 'tester') $role = 2;
			if ($old_role == 'god') $role = 1;
			
			$nick = "'".mysql_real_escape_string($row['nick'])."'";
			$pass = "'".md5("simple")."'";
			$activated = 0;
			$activation_code = "'".md5($mail)."'";
			$date_create = "null";
			$date_activated = "null";
			$date_last_signin = ($row['date_last_signup'] != null ? "'".$row['date_last_signup']."'" : "null");
			$deleted = 0;

			$query3 = "
insert into users(uuid, role, nick, mail, pass, activated, activation_code, date_create, date_activated, date_last_signin, deleted) 
values( $guid, $role, $nick, $mail, $pass, $activated, $activation_code, $date_create, $date_activated, $date_last_signin, $deleted);";
			echo $query3;
			$db->query( $query3 );
			echo "</pre>";
		}
		mysql_free_result($result2);
		
		
		
		
	}
	mysql_free_result($result);
?>
