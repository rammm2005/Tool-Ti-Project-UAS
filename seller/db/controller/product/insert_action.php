<?php
session_start();
require_once "../../connect.php";
require_once 'product.php';
require_once 'image.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $conn = $database->getConnection();
    $produk = new Product;
    $image = new Image;

    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['desk'];
    $spesifikasi = $_POST['spesifikasi'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $id_warna = $_POST['id_warna'];
    $produk_status = $_POST['produk_status'];
    $id_ukuran = $_POST['id_ukuran'];
    $id_seller = $_SESSION['user_id'];

    if (isset($_FILES['file'])) {
        $pondData = $_FILES['file'];

        // Generate product code
        $kode_produk = $produk->idGenerate();

        if ($produk->insertProduct($kode_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status)) {
            if ($image->insertImage($kode_produk, $pondData)) {
                header('Location: ../../../produk/produk.php?unique-seller=' . $id_seller . '&success=added');
                exit();
            } else {
                // Log error for debugging
                header('Location: ../../../produk/add-produk.php?unique-seller=' . $id_seller . '&error=missing_fields');
                exit();
            }
        } else {
            header('Location: ../../../produk/add-color.php?unique-seller=' . $id_seller . '&error=eror_insert');
            exit();
        }
    } else {
        header('Location: ../../../produk/add-color.php?unique-seller=' . $id_seller . '&error=no_img_upload');
        exit();
    }
}
?>
