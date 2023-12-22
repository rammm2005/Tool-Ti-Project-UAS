<?php

require_once "../../connect.php";

class Product extends Database {

    public function insertProduct($kode_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status) {
        $id_warna_str = implode(',', $id_warna);
        $id_ukuran_str = implode(',', $id_ukuran);

        $sql = "INSERT INTO produk (kode_produk, nama_produk, deskripsi, spesifikasi, stok, harga, id_warna, id_ukuran, id_seller, produk_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssssssssi", $kode_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna_str, $id_ukuran_str, $id_seller, $produk_status);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error: " . $stmt->errno . " - " . $stmt->error);
        }
    }
    
    
    

    public function idGenerate() {
        $id = '';

        $array = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-";

        for ($i = 0; $i < 20; $i++) {
            $id .= $array[rand(0, strlen($array) - 1)];
        }

        return $id;
    }
}

?>
