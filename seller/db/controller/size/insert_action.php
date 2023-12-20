<?php
session_start();
require_once 'size.php'; 

$sizeHandler = new Size();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-ukuran'])) {
    $id_seller = $_SESSION['user_id'];
    $besar_ukuran = $_POST['besar_ukuran'];
    $desk = $_POST['desk'];
    $id_ukuran = $sizeHandler->idGenerate();

    // var_dump($id_seller, $besar_ukuran, $id_seller, $id_ukuran);
    if (empty($id_ukuran) || empty($besar_ukuran) || empty($id_seller) || empty($desk)) {
        header('Location: ../../../produk/add-size.php?unique-seller=' . $id_seller . '&error=missing_fields');
        exit();
    }

    $sizeHandler->insertSize( $id_ukuran, $besar_ukuran, $id_seller, $desk);
    header('Location: ../../../produk/size-manage.php?unique-seller=' . $id_seller.'&success=added');
    exit();

}


?>