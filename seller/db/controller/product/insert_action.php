<?php
session_start();
require_once 'Product.php'; 

$productHandler = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id_seller = $_SESSION['id_seller'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $spesifikasi = $_POST['spesifikasi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_warna = $_POST['id_warna'];
    $id_ukuran = $_POST['id_ukuran'];
    // $id_seller = $_POST['id_seller'];
    $produk_status = $_POST['produk_status'];

    if (empty($id_seller) || empty($nama_produk) || empty($id_warna) || empty($id_ukuran) || empty($produk_status) || empty($deskripsi) || empty($spesifikasi) || empty($stok) || empty($harga)) {
        header('Location: ../../../profile/profile.php?unique-seller=' . $id_seller . '&error=missing_fields');
        exit();
    }

    $productHandler->insertProduct($id_produk,$nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status);
    header('Location: ../../../profile/profile.php?unique-seller=' . $id_seller.'&success=added');
    exit();

}


?>