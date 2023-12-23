<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}

require_once('../../connect.php');
require_once('Product.php');
require_once('Image.php');

$product = new Product();
$image = new Image();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['desk'];
    $spesifikasi = $_POST['spesifikasi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_warna = $_POST['id_warna'];
    $id_ukuran = $_POST['id_ukuran'];
    $id_seller = $_SESSION['user_id'];
    $produk_status = $_POST['produk_status'];
    // $kode_image = $_POST['kode_image'];  


    $updateResult = $product->updateProduct($kode_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status);

    $updateImageResult = $image->updateImages($kode_produk, $_FILES['file']);

    // Handle image deletion
    $deletedImages = $_POST['deleted_images'] ?? [];
    foreach ($deletedImages as $deletedImage) {
        $image->deleteImage($deletedImage);
    }

    if ($updateResult && $updateImageResult) {
        header("Location: ../../../produk/produk.php?unique-seller='". $id_seller ."'&success=updated");
        exit();
    } else {
        header("Location: ../../../produk/edit-produk.php?unique-seller=$id_seller&product-code=$kode_produk&error=update_error");
        exit();
    }
}
?>
