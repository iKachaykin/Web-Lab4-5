<?php
require_once("/utils/errors.php");
if(empty($_GET)) {
	reportAboutError("Invalid input: check inputed data!");
}

if($_GET["action"]=="user") {
		require_once("/actions/user.php");
}
elseif ($_GET["action"]=="data") {
		require_once("/actions/data.php");
}
else
	reportAboutError("Invalid input: check action!");
?>