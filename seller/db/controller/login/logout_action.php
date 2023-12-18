<?php
session_start();
require_once 'auth.php';

$auth = new Auth();
$auth->logout();


header('Location: ../../../login/login.php');
exit();
?>
