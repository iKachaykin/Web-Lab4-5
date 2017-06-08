<?php
require_once("functions.php");
function reportAboutError($msg) {
	answer(array("Error:"=> ${msg}));
}
?>