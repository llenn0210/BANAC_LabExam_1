<?php

require 'Database.php';
require 'Auth.php';


$db = (new Database())->connect();
$auth = new Auth($db);


$auth->logout();
header("Location: Log_in.php");
exit;






?>