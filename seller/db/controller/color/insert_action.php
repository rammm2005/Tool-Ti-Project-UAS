<?php
session_start();
require_once 'color.php'; 

$colorHandler = new Color();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-warna'])) {
    $id_seller = $_SESSION['user_id'];
    $nama_warna = $_POST['nama_warna'];
    $kode_warna = $_POST['kode_warna'];
    $id_warna = $colorHandler->idGenerate();
    if (empty($id_warna) || empty($nama_warna) || empty($kode_warna)) {
        header('Location: ../../../produk/add-color.php?unique-seller=' . $id_seller . '&error=missing_fields');
        exit();
    }

    $colorHandler->insertColor( $id_warna, $nama_warna, $kode_warna);
    header('Location: ../../../produk/color-manager.php?unique-seller=' . $id_seller.'&success=added');
    exit();

}


?>