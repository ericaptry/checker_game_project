<?php

include_once 'include/setup.php';


include_once 'users/command/users.php';

executeViewUsers();

$targetContent = 'users/template/users.php';

include_once 'include/GenericTemplate.php';


?>