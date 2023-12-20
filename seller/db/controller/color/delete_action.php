<?php
session_start();
require_once 'color.php'; 

$colorHandler = new Color();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_warna'])) {
    $id_warna = $_POST['id_warna'];
    $id_seller = $_SESSION['id_seller'];

    if (empty($id_warna)) {
        header('Location: ../../../produk/color-manager.php?unique-seller=' . $id_seller . '&error=failedDel');
        exit();
    }

    $colorHandler->deleteColor($id_warna);

    header('Location: ../../../produk/color-manager.php?unique-seller=' . $id_seller . '&delete=deleted');
    exit();
}


?>
