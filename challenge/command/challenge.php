<?php
$challenged  = "";

//Starting String
$STARTING_PIECES_RED   = "0.0:0.2:0.4:0.6:1.1:1.3:1.5:1.7:2.0:2.2:2.4:2.6:";
$STARTING_PIECES_BLACK = "5.1:5.3:5.5:5.7:6.0:6.2:6.4:6.6:7.1:7.3:7.5:7.7";

function executeChallenge() {
	global $challenged;

	if(!empty($_POST['player']))
		$challenged = trim($_POST['player']);

	return executeChallengeCommand();
}


function executeChallengeCommand() {
	global $challenged, $ErrorMessages, $STARTING_PIECES_RED, $STARTING_PIECES_BLACK;

	
	$f = fopen('data/challenge.txt', "a");
	

	$array = array(0, $_SESSION['email'], $challenged, 12, $STARTING_PIECES_RED.$STARTING_PIECES_BLACK);
	

	fputs($f, implode(",", $array) . "\n");
	

	fclose($f);

	return true;
	
}


?>