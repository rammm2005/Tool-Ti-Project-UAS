<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $sellername = $_POST['sellername'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validasi password
    if ($password !== $confirmPassword) {
        die("Password and Confirm Password do not match.");
    }

    // Melakukan registrasi
    $auth = new Auth();
    $id_seller = $auth->generateIdSeller();
    $status_seller = '1';

    if ($auth->register($id_seller, $email, $sellername, $password, $status_seller)) {
        echo "Registration successful. You can now <a href='../../../login/login.php'>login</a>.";
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>
