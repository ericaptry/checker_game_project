<?php

include_once 'include/setup.php';

unset($_SESSION['email']);
unset($_SESSION['firstname']);
session_destroy();


header("Location: index.php");

?>