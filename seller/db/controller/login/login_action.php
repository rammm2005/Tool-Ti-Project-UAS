<?php
require_once 'auth.php';

$login = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];

    // Melakukan login
    if ($login->login($email, $passwords)) {
        header('Location: ../../../index.php');
        exit();
    } else {
        die("Login failed. Please check your email and password.");
    }
}
?>
