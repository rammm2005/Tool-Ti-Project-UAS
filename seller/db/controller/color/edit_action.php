<?php
session_start();
require_once 'color.php'; 

$colorHandler = new Color();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-warna'])) {
    $id_seller = $_SESSION['user_id'];
    $nama_warna = $_POST['nama_warna'];
    $kode_warna = $_POST['kode_warna'];
    $id_warna = $_POST['id_warna'];

    // var_dump($id_seller, $nama_warna, $kode_warna, $id_warna);
    if (empty($id_warna) || empty($nama_warna) || empty($kode_warna) || empty($id_seller)) {
        header('Location: ../../../produk/edit-color.php?unique-seller=' . $id_seller . '&color-code=' . $id_warna . '&error=missing_fields');
        exit();
    }

    $colorHandler->editColor($id_warna, $nama_warna, $kode_warna, $id_seller);
    header('Location: ../../../produk/color-manager.php?unique-seller=' . $id_seller.'&success=edited');
    exit();
}


?>