<?php
	
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
	$tables = array();
	
	$tables['feedback'] = array();
	$tables['feedback']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['feedback']['typeFB'] = array ( 'Field' => 'typeFB', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback']['full_text'] = array ( 'Field' => 'full_text', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback']['author'] = array ( 'Field' => 'author', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback']['dt'] = array ( 'Field' => 'dt', 'Type' => 'datetime', 'Null' => 'YES', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['users_profile'] = array();
	$tables['users_profile']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['users_profile']['userid'] = array ( 'Field' => 'userid', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_profile']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_profile']['value'] = array ( 'Field' => 'value', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_profile']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'YES', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	
	$tables['users_games'] = array();
	$tables['users_games']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['users_games']['userid'] = array ( 'Field' => 'userid', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_games']['gameid'] = array ( 'Field' => 'gameid', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_games']['score'] = array ( 'Field' => 'score', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_games']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'YES', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['users_ips'] = array();
	$tables['users_ips']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['users_ips']['userid'] = array ( 'Field' => 'userid', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['users_ips']['ip'] = array ( 'Field' => 'ip', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['users_ips']['country'] = array ( 'Field' => 'country', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['users_ips']['city'] = array ( 'Field' => 'city', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['users_ips']['client'] = array ( 'Field' => 'client', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['users_ips']['date_sign_in'] = array ( 'Field' => 'date_sign_in', 'Type' => 'datetime', 'Null' => 'YES', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
          
	$tables['feedback_msg'] = array();
	$tables['feedback_msg']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['feedback_msg']['feedback_id'] = array ( 'Field' => 'feedback_id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback_msg']['msg'] = array ( 'Field' => 'msg', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback_msg']['author'] = array ( 'Field' => 'author', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['feedback_msg']['dt'] = array ( 'Field' => 'dt', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['games'] = array();
	$tables['games']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['games']['uuid_game'] = array ( 'Field' => 'uuid_game', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['title'] = array ( 'Field' => 'title', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['logo'] = array ( 'Field' => 'logo', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['type_game'] = array ( 'Field' => 'type_game', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['date_create'] = array ( 'Field' => 'date_create', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['date_start'] = array ( 'Field' => 'date_start', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['date_stop'] = array ( 'Field' => 'date_stop', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['date_restart'] = array ( 'Field' => 'date_restart', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['rating'] = array ( 'Field' => 'rating', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['json_data'] = array ( 'Field' => 'json_data', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['json_security_data'] = array ( 'Field' => 'json_security_data', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['owner'] = array ( 'Field' => 'owner', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['games']['description'] = array ( 'Field' => 'description', 'Type' => 'text(4096)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
  	
	$tables['news'] = array();
	$tables['news']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['news']['text'] = array ( 'Field' => 'text', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['news']['datetime_'] = array ( 'Field' => 'datetime_', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['news']['author'] = array ( 'Field' => 'author', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['quest'] = array();
	$tables['quest']['idquest'] = array ( 'Field' => 'idquest', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['quest']['tema'] = array ( 'Field' => 'tema', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['subject'] = array ( 'Field' => 'subject', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(300)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['short_text'] = array ( 'Field' => 'short_text', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['short_text_copy'] = array ( 'Field' => 'short_text_copy', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['text'] = array ( 'Field' => 'text', 'Type' => 'varchar(4048)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['text_copy'] = array ( 'Field' => 'text_copy', 'Type' => 'varchar(4048)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['answer'] = array ( 'Field' => 'answer', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['answer_copy'] = array ( 'Field' => 'answer_copy', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['answer_upper_md5'] = array ( 'Field' => 'answer_upper_md5', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['score'] = array ( 'Field' => 'score', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['id_game'] = array ( 'Field' => 'id_game', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['gameid'] = array ( 'Field' => 'gameid', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['min_score'] = array ( 'Field' => 'min_score', 'Type' => 'int(10)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['quest']['for_person'] = array ( 'Field' => 'for_person', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['quest']['idauthor'] = array ( 'Field' => 'idauthor', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['quest']['author'] = array ( 'Field' => 'author', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['state'] = array ( 'Field' => 'state', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['description_state'] = array ( 'Field' => 'description_state', 'Type' => 'varchar(4048)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['quest_uuid'] = array ( 'Field' => 'quest_uuid', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['date_create'] = array ( 'Field' => 'date_create', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['quest']['userid'] = array ( 'Field' => 'userid', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['quest']['count_user_solved'] = array ( 'Field' => 'count_user_solved', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );

/*
	$tables['tasks'] = array();
	$tables['tasks']['taskid'] = array ( 'Field' => 'taskid', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['tasks']['tema'] = array ( 'Field' => 'tema', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(300)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['short_description'] = array ( 'Field' => 'short_description', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['description'] = array ( 'Field' => 'description', 'Type' => 'varchar(4048)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['answer'] = array ( 'Field' => 'answer', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['score'] = array ( 'Field' => 'score', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['min_score'] = array ( 'Field' => 'min_score', 'Type' => 'int(10)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['tasks']['gameid'] = array ( 'Field' => 'id_game', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['personal_userid'] = array ( 'Field' => 'personal_userid', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['tasks']['authorid'] = array ( 'Field' => 'authorid', 'Type' => 'bigint(20)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['tasks']['author'] = array ( 'Field' => 'author', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['status'] = array ( 'Field' => 'status', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tasks']['description_status'] = array ( 'Field' => 'description_status', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
*/

	$tables['teams'] = array();
	$tables['teams']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['teams']['uuid_team'] = array ( 'Field' => 'uuid_team', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['rating'] = array ( 'Field' => 'rating', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['teams']['logo'] = array ( 'Field' => 'logo', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['title'] = array ( 'Field' => 'title', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['date_create'] = array ( 'Field' => 'date_create', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['owner'] = array ( 'Field' => 'owner', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['json_data'] = array ( 'Field' => 'json_data', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['teams']['json_security_data'] = array ( 'Field' => 'json_security_data', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['tryanswer'] = array();
	$tables['tryanswer']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['tryanswer']['iduser'] = array ( 'Field' => 'iduser', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer']['idquest'] = array ( 'Field' => 'idquest', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer']['answer_try'] = array ( 'Field' => 'answer_try', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer']['answer_real'] = array ( 'Field' => 'answer_real', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer']['passed'] = array ( 'Field' => 'passed', 'Type' => 'varchar(10)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer']['datetime_try'] = array ( 'Field' => 'datetime_try', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['updates'] = array();
	$tables['updates']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['updates']['from_version'] = array ( 'Field' => 'from_version', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['version'] = array ( 'Field' => 'version', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['description'] = array ( 'Field' => 'description', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['result'] = array ( 'Field' => 'result', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['userid'] = array ( 'Field' => 'userid', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['updates']['datetime_update'] = array ( 'Field' => 'datetime_update', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['tryanswer_backup'] = array();
	$tables['tryanswer_backup']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['tryanswer_backup']['iduser'] = array ( 'Field' => 'iduser', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer_backup']['idquest'] = array ( 'Field' => 'idquest', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer_backup']['answer_try'] = array ( 'Field' => 'answer_try', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer_backup']['answer_real'] = array ( 'Field' => 'answer_real', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer_backup']['passed'] = array ( 'Field' => 'passed', 'Type' => 'varchar(10)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['tryanswer_backup']['datetime_try'] = array ( 'Field' => 'datetime_try', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['user'] = array();
	$tables['user']['iduser'] = array ( 'Field' => 'iduser', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['user']['uuid_user'] = array ( 'Field' => 'uuid_user', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['username'] = array ( 'Field' => 'username', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['email'] = array ( 'Field' => 'email', 'Type' => 'varchar(128)', 'Null' => 'NO', 'Key' => 'UNI', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['password'] = array ( 'Field' => 'password', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['logo'] = array ( 'Field' => 'logo', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['role'] = array ( 'Field' => 'role', 'Type' => 'varchar(10)', 'Null' => 'YES', 'Key' => '', 'Default' => 'user', 'Extra' => '', );
	$tables['user']['nick'] = array ( 'Field' => 'nick', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['rating'] = array ( 'Field' => 'rating', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => '0', 'Extra' => '', );
	$tables['user']['activation_code'] = array ( 'Field' => 'activation_code', 'Type' => 'varchar(255)', 'Null' => 'YES', 'Key' => '', 'Default' => '', 'Extra' => '', );
	$tables['user']['date_create'] = array ( 'Field' => 'date_create', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['date_activated'] = array ( 'Field' => 'date_activated', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['date_last_signup'] = array ( 'Field' => 'date_last_signup', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['user']['last_ip'] = array ( 'Field' => 'last_ip', 'Type' => 'varchar(255)', 'Null' => 'YES', 'Key' => '', 'Default' => '', 'Extra' => '', );
	$tables['user']['ipserver'] = array ( 'Field' => 'ipserver', 'Type' => 'varchar(255)', 'Null' => 'YES', 'Key' => '', 'Default' => '', 'Extra' => '', );

	$tables['userquest'] = array();
	$tables['userquest']['iduser'] = array ( 'Field' => 'iduser', 'Type' => 'int(10)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => '', );
	$tables['userquest']['idquest'] = array ( 'Field' => 'idquest', 'Type' => 'int(10)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => '', );
	$tables['userquest']['stopdate'] = array ( 'Field' => 'stopdate', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['userquest']['startdate'] = array ( 'Field' => 'startdate', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['userteams'] = array();
	$tables['userteams']['id_user'] = array ( 'Field' => 'id_user', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	// $tables['userteams']['id_team'] = array ( 'Field' => 'id_team', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['userteams']['date_begin'] = array ( 'Field' => 'date_begin', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['userteams']['date_end'] = array ( 'Field' => 'date_end', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['flags'] = array();
	$tables['flags']['id'] = array ( 'Field' => 'id', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['flags']['idservice'] = array ( 'Field' => 'idservice', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags']['flag'] = array ( 'Field' => 'flag', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags']['owner'] = array ( 'Field' => 'owner', 'Type' => 'varchar(300)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags']['date_start'] = array ( 'Field' => 'date_start', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags']['date_end'] = array ( 'Field' => 'date_end', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags']['user_passed'] = array ( 'Field' => 'user_passed', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['flags_live'] = array();
	$tables['flags_live']['id'] = array ( 'Field' => 'id', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['flags_live']['idservice'] = array ( 'Field' => 'idservice', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags_live']['flag'] = array ( 'Field' => 'flag', 'Type' => 'varchar(50)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags_live']['owner'] = array ( 'Field' => 'owner', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags_live']['date_start'] = array ( 'Field' => 'date_start', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags_live']['date_end'] = array ( 'Field' => 'date_end', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['flags_live']['user_passed'] = array ( 'Field' => 'user_passed', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['services'] = array();
	$tables['services']['id'] = array ( 'Field' => 'id', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['services']['idgame'] = array ( 'Field' => 'idgame', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['services']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(300)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['services']['scriptpath'] = array ( 'Field' => 'scriptpath', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['services']['comment'] = array ( 'Field' => 'comment', 'Type' => 'varchar(4048)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );

	$tables['advisers'] = array();
	$tables['advisers']['id'] = array ( 'Field' => 'id', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );	
	$tables['advisers']['title'] = array ( 'Field' => 'title', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['advisers']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['advisers']['owner'] = array ( 'Field' => 'owner', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => 'MUL', 'Default' => NULL, 'Extra' => '', );
	$tables['advisers']['text'] = array ( 'Field' => 'text', 'Type' => 'text', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['advisers']['mark'] = array ( 'Field' => 'mark', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['advisers']['idgame'] = array ( 'Field' => 'idgame', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	$tables['advisers']['checked'] = array ( 'Field' => 'checked', 'Type' => 'int(11)', 'Null' => 'NO', 'Key' => '', 'Default' => '0', 'Extra' => '', );
	
	$tables['scoreboard'] = array();
	$tables['scoreboard']['id'] = array ( 'Field' => 'id', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => 'PRI', 'Default' => NULL, 'Extra' => 'auto_increment', );
	$tables['scoreboard']['idgame'] = array ( 'Field' => 'idgame', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['scoreboard']['name'] = array ( 'Field' => 'name', 'Type' => 'varchar(255)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['scoreboard']['owner'] = array ( 'Field' => 'owner', 'Type' => 'varchar(300)', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['scoreboard']['score'] = array ( 'Field' => 'score', 'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	$tables['scoreboard']['date_change'] = array ( 'Field' => 'date_change', 'Type' => 'datetime', 'Null' => 'NO', 'Key' => '', 'Default' => NULL, 'Extra' => '', );
	
	// $tables['userteams'] = array();

	$db = new fhq_database();
	
	echo "<a href='?'>try_update</a> | ";
	echo "<a class='btn btn-small btn-info' href='javascript:void(0);' onclick=\"load_content_page('update_db_gen_code');\">Generate info about tables</a>
	<br>";
	
	function update_info($db)
	{
		$tables_db = array();
		$result = $db->query("SHOW TABLES;");
		while ($row = mysql_fetch_row($result)) // Data
		{
			$table = $row[0];
			$tables_db[$table] = array();
			/*if (!isset($tables[$table])) {
				//echo "<pre>Table: $table<br>INFO: You can drop this table: '$table'.</pre><hr>";
			}*/
			
			if (isset($_GET['gen_code'])) {
				echo "<br>\$tables['$table'] = array(); <br>";
			}
			
			// columns
			$result2 = $db->query("DESCRIBE $table;");
			while ($row2 = mysql_fetch_row($result2, MYSQL_ASSOC)) // Data
			{
				$column = $row2['Field'];
				$tables_db[$table][$column] = $row2;
				if (isset($_GET['gen_code'])) {
					echo "\$tables['$table']['$column'] = ";
					var_export($row2);
					echo ";<br>";
				}
				// echo $column;
			}
			mysql_free_result($result2);
		}
		mysql_free_result($result);
		return $tables_db;
	}
	
	function create_table ($db, $table, $columns) {
		
		$info = NULL;
		foreach( $columns as $key => $val ) {
			if ($info == NULL) $info = $val;
		}
		
		$column = $info['Field'];
		$type = $info['Type'];
		$extra = $info['Extra'];
		$extra2 = ($extra == 'auto_increment' ? 'AUTO_INCREMENT=1' : '');
		$notnull = '';
		if ($info['Null'] == 'NO') $notnull = 'NOT NULL';

		$key = $info['Key'];
		$index = '';
		if ($key == 'PRI')
			$index = ", PRIMARY KEY (`$column`)";
		if ($key == 'UNI')
			$index = ", UNIQUE KEY `$column` (`$column`)";
		if ($key == 'MUL')
			$index = ", KEY `$column` (`$column`)";			

		$query = "CREATE TABLE $table (
				`$column` $type $notnull $extra
				$index
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 $extra2";
		echo "$query = ".$db->query($query)."<br>";
	}

	function add_column ($db, $table, $info) {
		$column = $info['Field'];
		$type = $info['Type'];
		$notnull = '';
		
		$extra = $info['Extra'];
		if ($info['Type'] == 'NO') $notnull = 'NOT NULL';
		$query = "ALTER TABLE `$table` ADD `$column` $type $notnull $extra;";
		echo "$query = ".$db->query($query)."<br>";
		
		if ($info['Default'] != NULL) {
			$query = "ALTER TABLE `$table` ALTER COLUMN `$column` SET DEFAULT ".$info['Default'].";";
			echo "$query = ".$db->query($query)."<br>";
		}
	}
	
	function add_index ($db, $table, $info) {
		$column = $info['Field'];
		
		$index = $info['Key'];
		
		$query = '';
		// add index
		if ($index == 'MUL')
			$query = "ALTER TABLE `$table` ADD INDEX (`$column`);";
		else if ($index == 'UNI')
			$query = "ALTER TABLE `$table` ADD UNIQUE  (`$column`);";
		else if ($index == 'PRI')
			$query = "ALTER TABLE `$table` ADD PRIMARY KEY (`$column`);";
		else if ($index == '')
			$query = '';
		else
			echo "Error!!! unknown index key: $index <br>";
		
		if ($query != '')
			echo "$query = ".$db->query($query)."<br>";
	}
	
	$tables_db = update_info($db);
	
	if (isset($_GET['gen_code'])) {
		exit;
	}

	echo "<hr>";

	// drop tables
	foreach ($tables_db as $table => $columns)
	{
		if (!isset($tables[$table])) {
			echo "<pre>Table: $table<br>INFO: You can drop this table: '$table'. (DROP TABLE `$table`;)</pre><hr>";
		}
	}
	
	// create tables
	foreach ($tables as $table => $columns)
	{
		echo "<pre>Table: $table<br>";	
		if (!isset($tables_db[$table])) {
			echo "Create table...<br>";
			create_table($db, $table, $columns);
			$tables_db = update_info($db);
		}
		
		$columns_db = $tables_db[$table];
		
		// drop columns
		foreach ($columns_db as $column => $info)
		{
			if (!isset($columns[$column]))
				echo "INFO: You can drop column $column. (ALTER TABLE `$table` DROP COLUMN `$column`;)<br>";
		}
		
		// create columns
		foreach ($columns as $column => $info)
		{
			if (!isset($columns_db[$column])) {
				$type = $info['Type'];
				
				add_column($db, $table, $info);
				$key = $info['Key'];
				if ($key != '')
					add_index($db, $table, $info);
			}
		}

		echo "</pre><hr>";
	}
?>


