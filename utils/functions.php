<?php
function answer($val) {
	echo json_encode($val);
	exit();
}
function answerLogin($msg) {
	answer(array("SessionId"=> ${msg}, "Error"=> "null"));
}
function infSession($msg) {	
	answer(array("Result"=> ${msg}, "Error"=> "null"));
}
?>