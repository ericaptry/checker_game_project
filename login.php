<?php

include_once 'include/setup.php';

include_once 'login/command/login.php';


if(!strcasecmp($_SERVER['REQUEST_METHOD'], "get") || !executeLogin()) {
	$targetContent= 'login/template/login.php';
} else {
	$targetContent = 'login/template/success.php';
}


include_once 'include/GenericTemplate.php';


?>