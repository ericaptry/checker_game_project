<?php
if(!isset($email))$email="";
if(!isset($pass1))$pass1="";


function executeLogin() {
	global $email, $pass1;


	if(!empty($_POST['email']))
		$email = strtolower(trim($_POST['email']));

	if(!empty($_POST['pass1']))
		$pass1 = trim($_POST['pass1']);


	return executeLoginCommand();
}


function executeLoginCommand() {
	global $firstname, $email, $pass1, $ErrorMessages;
	
	//Open File
	$f = fopen('data/members.txt', "r");
	while (($buffer = fgets($f)) !== false) {
		
		$buffer = trim($buffer);
		if(empty($buffer)) continue;
		
		list($e, $p, $fn, $ln, $ph) = explode(",", $buffer);
		if(!strcmp($email, $e) && !strcmp($pass1, $p)) {
		
			
			//Close the file
			fclose($f);
			
		
			$_SESSION['email'] = $e;

			
			$_SESSION['firstname'] = $firstname = $fn;

			return true;			
		}
	}
	
	//Did not find a match
	fclose($f);
	$ErrorMessages['email'] = "No email and password matching what you provided was found.";
	return false;
}

?>