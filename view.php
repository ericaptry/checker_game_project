<?php

include_once 'include/setup.php';


include_once 'game/command/view.php';

if(!executeViewGame()) {
	$targetContent= 'game/template/fail.php';
} else {
	array_push($JavascriptInit, "buildBoard()");
	array_push($JavascriptInit, "placePieces()");	
	$targetContent= 'game/template/view.php';
}


include_once 'include/GenericTemplate.php';


?>