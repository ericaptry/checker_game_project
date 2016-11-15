<?php

include_once 'include/setup.php';


include_once 'game/command/view.php';
include_once 'game/command/play.php';

if(!strcasecmp($_SERVER['REQUEST_METHOD'], "get")) {
	
	header("Location: view.php?player=".$_SESSION['email']);
} else if(!executeViewGame()) {
	$targetContent= 'game/template/fail.php';
	include_once 'include/GenericTemplate.php';
} else if (!executePlayGame()) { 

	array_push($JavascriptInit, "buildBoard()");
	array_push($JavascriptInit, "placePieces()");	
	$targetContent= 'game/template/view.php';
	include_once 'include/GenericTemplate.php';
} else {

	header("Location: view.php?player=".$_SESSION['email']);
}


?>