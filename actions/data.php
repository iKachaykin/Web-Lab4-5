<?php
require_once("/utils/errors.php");
require_once("/internal/available-users.php");
if(empty($_GET)) {
	reportAboutError("Invalid input: check inputed data!");
}

else {
	if($_GET["method"] == "get") {
		if(!isset($_GET["sessionid"])) {
			reportAboutError("Invalid input: check inputed data!");
		}
		else refreshSession($_GET["sessionid"]);
	}
	elseif($_GET["method"]=="set") {
		if(!isset($_GET["sessionid"])) {
			reportAboutError("Invalid input: check inputed data!");
		}
		elseif(!isset($_GET["text"])) {
			reportAboutError("Invalid input: check inputed data!");
		}
		else setText($_GET["sessionid"], $_GET["text"]);
	}
	else {
		reportAboutError("Invalid input: check method!");
	}
}
?>