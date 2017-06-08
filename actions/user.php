<?php

require_once("/utils/errors.php");
require_once("/internal/available-users.php");
if(empty($_GET)) {
	reportAboutError("Invalid input: check inputed data!");
}
else {
	if($_GET["method"]=="login") {
		if(!isset($_GET["username"])) {
			reportAboutError("Invalid input: check username!");
		}
		elseif (!isset($_GET["pass"])) {
			reportAboutError("Invalid input: check password!");
		}
		else serverLogin($_GET["username"], $_GET["pass"]);
	}
	elseif($_GET["method"]=="logout") {
		if(!isset($_GET["sessionid"])) {
			reportAboutError("Invalid input: check inputed data!");
		}
		else unlinkSession($_GET["sessionid"]);
	}
	else {
		reportAboutError("Invalid input: check method!");
	}
}
?>