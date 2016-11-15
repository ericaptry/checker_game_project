<?php


include_once 'include/setup.php';

include_once 'challenge/command/challenge.php';



if(!strcasecmp($_SERVER['REQUEST_METHOD'], "get") || !executeChallenge()) {
	header("Location: users.php");
} else {
	header("Location: view.php?player=".$_SESSION['email']);
}


?>