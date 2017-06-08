<?php
require_once("/utils/errors.php");
require_once("/utils/functions.php");
function serverLogin($inputed_username, $inputed_password) {
	if(file_exists(dirname(__DIR__)."/data/${inputed_username}.txt")) {
		if($inf_file = fopen(dirname(__DIR__)."/data/${inputed_username}.txt", 'r')) {
			while(!feof($inf_file)) {
				$inf_file_buff = fgets($inf_file);
				$splited_buff = preg_split("/[\s]+/", $inf_file_buff);
				if (strcmp($splited_buff[1], $inputed_password) === 0) {
					$gen_session_id = uniqid();
					if($file_user_name_sessions = fopen(dirname(__DIR__)."/sessions/${inputed_username}.txt", 'a+')) {
						$tmp_text = fgets($file_user_name_sessions);
					}
					else $tmp_text = "";
					$file_user_name_sessions = fopen(dirname(__DIR__)."/sessions/${gen_session_id}.txt", 'w');
					fwrite($file_user_name_sessions, "${inputed_username}-${tmp_text}"); 
					fclose($file_user_name_sessions);
					infSession($gen_session_id);
				}
				else {
					reportAboutError("Invalid password input!");
				}
			}
		}
	}
	else {
		reportAboutError("There aren't any usernames, that match with ${inputed_username}!");
	}
}
function refreshSession($inputed_id) {
	if($inf_file = fopen(dirname(__DIR__)."/sessions/${inputed_id}.txt", 'r')) {
		while(!feof($inf_file)) {
			$inf_file_buff = fgets($inf_file);
			$splited_buff = preg_split("/[-\r\n]+/", $inf_file_buff);
			$get_session_inf = file_get_contents(dirname(__DIR__)."/sessions/${splited_buff[0]}.txt");
			infSession($get_session_inf);
		}	
	}
	else {
		reportAboutError("There aren't any sessions, that match with ${inputed_id}!");
	}

}

function setText($inputed_id, $val_to_set) {
	if($session_file = fopen(dirname(__DIR__)."/sessions/${inputed_id}.txt", 'a+')) {
		$session_buff = fgets($session_file);
		$inputed_username = preg_split("/[\s-]+/", $session_buff);
		$file_user_name_sessions = fopen(dirname(__DIR__)."/sessions/${inputed_username[0]}.txt", "w");
		fclose($session_file);
		fputs($file_user_name_sessions, "${val_to_set}");
		fclose($file_user_name_sessions);
		infSession("Success!");
	}
	else {
		reportAboutError("There aren't any sessions, that match with ${inputed_id}!");
	}
}

function unlinkSession($inputed_id) {
	if($inf_file = fopen(dirname(__DIR__)."/sessions/${inputed_id}.txt", 'r+')) {
		fclose($inf_file);
		unlink(dirname(__DIR__)."/sessions/${inputed_id}.txt");
		infSession("Success!");
	}
	else {
		reportAboutError("There aren't any sessions, that match with ${inputed_id}!");
	}
}
?>