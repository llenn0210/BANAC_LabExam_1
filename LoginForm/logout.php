<?php
session_start();

require_once __DIR__ . '/../Database.php';
require 'Auth.php';


$db = (new Database())->connect();
$auth = new Auth($db);


$auth->logout();
header("Location: login.php");
exit;






?>