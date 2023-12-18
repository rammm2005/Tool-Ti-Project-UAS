<?php

require_once "../../connect.php";


class Product extends Database{

    public function insertProduct($id_produk, $nama_produk, $deskripsi, $spesifikasi, $stok, $harga, $id_warna, $id_ukuran, $id_seller, $produk_status){
        $id_produk = $this->idGenerate();
        $sql = "INSERT INTO produk(id_produk,nama_produk,deskripsi,spesifikasi,stok,harga,id_warna,id_ukuran,id_seller,produk_status)VALUES ('$id_produk','$nama_produk','$deskripsi','$spesifikasi','$stok','$harga','$id_warna','$id_ukuran','$id_seller','$produk_status')";

        if($this->connection->query($sql) === TRUE){
            echo "Record added successfully";
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    private function idGenerate(){
        $id ='';

        $array = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-";


        for ($i = 0; $i < 20; $i++) {
            $id .= $array[rand(0, strlen($array) - 1)];
        }

        return $id;
    }
}

?>