<?php

require_once "../../connect.php";


class Color extends Database{

    public function insertColor($id_warna,$nama_warna,$kode_warna){
        $sql = "INSERT INTO warna(id_warna,nama_warna,kode_warna)VALUES ('$id_warna','$nama_warna','$kode_warna')";

        if($this->connection->query($sql) === TRUE){
            echo "Record added successfully";
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    

    public function idGenerate(){
        $id ='';

        $array = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-";


        for ($i = 0; $i < 5; $i++) {
            $id .= $array[rand(0, strlen($array) - 1)];
        }

        return $id;
    }
}

?>