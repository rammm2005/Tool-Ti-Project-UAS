<?php
require_once 'seller.php'; 

$sellerHandler = new Seller();
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_seller'])) {
    $id_seller = $_SESSION['user_id']; // Use the session value

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastnama = filter_input(INPUT_POST, 'lastnama', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $sellername = filter_input(INPUT_POST, 'sellername', FILTER_SANITIZE_STRING);
    $foto_seller = $_FILES['foto_seller']; 

    if (empty($id_seller) || empty($firstname) || empty($lastnama) || empty($email) || empty($sellername) || empty($foto_seller)) {
        header('Location: ../../../profile/profile.php?unique-seller=' . $id_seller . '&error=missing_fields');
        exit();
    }
    
    $sellerHandler->updateSeller($id_seller, $firstname, $lastnama, $email, $sellername, $foto_seller);

    header('Location: ../../../profile/profile.php?unique-seller=' . $id_seller.'&success=updated');
    exit();
}
?>
