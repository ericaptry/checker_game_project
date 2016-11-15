<?php
$users = array();


$usersInGameMap = array();


function executeViewUsers() {
	return executeViewUsersCommand();
}



function executeViewUsersCommand() {
	global $users, $usersInGameMap, $ErrorMessages;

	
	// Open File
	$f = fopen('data/members.txt', "r");
	while (($buffer = fgets($f)) !== false) {
		
		$buffer = trim($buffer);
		if(empty($buffer)) continue;
		
		list($e, $p, $fn, $ln, $ph) = explode(",", $buffer);
		//Skip password
		$user = array(
			"firstname" => $fn,
			"lastname" => $ln,
			"email" => $e,
			"phone" => $ph,
		);
		array_push($users, $user);
	}
	fclose($f);

	$f = fopen('data/challenge.txt', "r");
	while (($buffer = fgets($f)) !== false) {
	
		$buffer = trim($buffer);
		if(empty($buffer)) continue;
	

		list($turn, $p1, $p2) = explode(",", $buffer);
		
	
		$usersInGameMap[$p1] = true;
		$usersInGameMap[$p2] = true;
	}
	fclose($f);

}


?>