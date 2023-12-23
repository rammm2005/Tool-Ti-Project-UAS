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
    
    public function updateProduct($kode_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status) {
        $id_warna_str = implode(',', $id_warna);
        $id_ukuran_str = implode(',', $id_ukuran);

        $sql = "UPDATE produk SET nama_produk=?, deskripsi=?, spesifikasi=?, stok=?, harga=?, id_warna=?, id_ukuran=?, id_seller=?, produk_status=? WHERE kode_produk=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssssssssss", $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna_str, $id_ukuran_str, $id_seller, $produk_status, $kode_produk);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Error: " . $stmt->errno . " - " . $stmt->error);
        }
    }


    public function deleteProduct($kode_produk) {
        $this->connection->begin_transaction();

        try {
            $sql = "DELETE FROM produk WHERE kode_produk = ?";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("s", $kode_produk);

            if ($stmt->execute()) {
                $this->connection->commit();
                echo "Record deleted successfully";
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $this->connection->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            $this->connection->rollback();
            die($e->getMessage());
        }
    }

    public function getError() {
        return $this->connection->error;
    }

    public function markProductAsDeleted($kode_produk) {
        $sql = "DELETE FROM produk WHERE kode_produk = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $kode_produk);

        if ($stmt->execute()) {
            return true;
        } else {
            // Directly use mysqli error functions to handle errors
            $error = "Error updating product status to 'deleted'. Error: " . $stmt->errno . " - " . $stmt->error;

            // Log the error, or handle it as needed
            error_log($error);

            return false;
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
