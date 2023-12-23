<?php
session_start();
require_once 'product.php';

$productHandler = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produk'])) {
    $kode_produk = $_POST['id_produk'];

    if (empty($kode_produk)) {
        echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
        exit();
    }

    if ($productHandler->markProductAsDeleted($kode_produk)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $productHandler->getError()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
