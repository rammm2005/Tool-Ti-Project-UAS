<?php
session_start();
require_once 'size.php'; 

$sizeHandler = new Size();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-size'])) {
    $id_seller = $_SESSION['user_id'];
    $besar_ukuran = $_POST['besar_ukuran'];
    $desk = $_POST['desk'];
    $id_ukuran = $_POST['id_ukuran'];

    var_dump($id_seller, $besar_ukuran, $desk, $id_ukuran);
    if (empty($id_ukuran) || empty($besar_ukuran) || empty($desk) || empty($id_seller)) {
        header('Location: ../../../produk/edit-size.php?unique-seller=' . $id_seller . '&size-code=' . $id_ukuran . '&error=missing_fields');
        exit();
    }

    $sizeHandler->updateSize($id_ukuran, $besar_ukuran, $id_seller, $desk);
    header('Location: ../../../produk/size-manage.php?unique-seller=' . $id_seller.'&success=edited');
    exit();
}


?>