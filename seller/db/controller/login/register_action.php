<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $sellername = $_POST['sellername'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        header("Location: ../../../register/register.php?register=passsword_not_valid");
        exit();
    }


    $auth = new Auth();
    $id_seller = $auth->generateIdSeller();
    $status_seller = '1';

    if ($auth->register($id_seller, $email, $sellername, $password, $status_seller)) {
        header("Location: ../../../login/login.php?register=successfull");
        exit();
    } else {
        header("Location: ../../../register/register.php?register=failed");
        exit();
    }
}
?>
