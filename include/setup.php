<?php
//Session

ini_set('session.save_path', 'tmp');
session_start();


ini_set('error_reporting', E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "tmp/php-error.log");

//Error Messages

$ErrorMessages = array();

//initializing javascript
$JavascriptInit = array('startClock()');

//Security


?>