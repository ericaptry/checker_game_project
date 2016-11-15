<?php

$firstname = $lastname = $phone = $email = $pass1 = $pass2 = "";


function executeRegister() {
	global $firstname, $lastname, $phone, $email, $pass1, $pass2;
	
	if(!empty($_POST['firstname']))
		$firstname = trim($_POST['firstname']);
	
	if(!empty($_POST['lastname']))
		$lastname = trim($_POST['lastname']);
	
	if(!empty($_POST['phone']))
		$phone = trim($_POST['phone']);
	
	if(!empty($_POST['email']))
		$email = strtolower(trim($_POST['email']));
	
	if(!empty($_POST['pass1']))
		$pass1 = trim($_POST['pass1']);
	
	if(!empty($_POST['pass2']))
		$pass2 = trim($_POST['pass2']);
	
	return validateRegister() && executeRegisterCommand();
}

function validateRegister() {
	global $firstname, $lastname, $phone, $email, $pass1, $pass2, $ErrorMessages;
	
	if(empty($firstname)) $ErrorMessages['firstname'] = 'Firstname may not be blank.';
	if(empty($lastname)) $ErrorMessages['lastname'] = 'Lastname may not be blank.';
	
	if(empty($phone)) $ErrorMessages['phone'] = 'Phone may not be blank.';

	if(empty($email)) $ErrorMessages['email'] = 'Email may not be blank.';
	

	if(empty($pass1) || (strlen($pass1) < 8) || strcmp($pass1, $pass2)) $ErrorMessages['pass1'] = 'Password fields must match and be at least 8 characters long.';
	

	
	return empty($ErrorMessages);
}
 
function executeRegisterCommand() {
	global $firstname, $lastname, $phone, $email, $pass1, $pass2, $ErrorMessages;


	$f = fopen('data/members.txt', "a");
	

	fputs($f, implode(",", array($email, $pass1, $firstname, $lastname, $phone)) . "\n");
	

	fclose($f);

	include_once 'login/command/login.php';
	return executeLoginCommand();
	
}


?>