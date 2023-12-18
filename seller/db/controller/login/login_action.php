<?php
session_start();
require_once 'auth.php';

$login = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];

    // Melakukan login
    if ($login->login($email, $passwords)) {
        $_SESSION['user_id'] = $login->getUserId(); 
        header('Location: ../../../index.php');
        exit();
    } else {
        header("Location: ../../../login/login.php?login_error=failed");
        exit();
    }
}
?>
