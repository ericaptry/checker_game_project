<?php

include_once 'include/setup.php';


include_once 'register/command/register.php';



if(!strcasecmp($_SERVER['REQUEST_METHOD'], "get") || !executeRegister()) {
	$targetContent= 'register/template/register.php';
} else {
	$targetContent = 'register/template/success.php';
}

include_once 'include/GenericTemplate.php';


?>