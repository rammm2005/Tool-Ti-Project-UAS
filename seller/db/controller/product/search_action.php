<?php

session_start();
require_once('../db/connect.php');

if (isset($_GET['search_query'])) {
    $searchQuery = $_GET['search_query'];

    $query = "SELECT * FROM produk 
              WHERE id_seller = '" . $_SESSION['user_id'] . "' 
                AND (nama_produk LIKE '%$searchQuery%'
                    OR stok LIKE '%$searchQuery%'
                    OR id_seller LIKE '%$searchQuery%'
                    OR kode_produk LIKE '%$searchQuery%'
                    OR spesifikasi LIKE '%$searchQuery%'
                    OR harga LIKE '%$searchQuery%'
                    OR produk_status LIKE '%$searchQuery%'
                    OR id_warna LIKE '%$searchQuery%'
                    OR id_ukuran LIKE '%$searchQuery%'
                    OR deskripsi LIKE '%$searchQuery%')";

    $connection = new Database();
    $sql = mysqli_query($connection->getConnection(), $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = $row;
    }

    echo json_encode(['success' => true, 'data' => $data]);
} else {
    echo json_encode(['success' => false, 'error' => 'Search query parameter is missing.']);
}
?>