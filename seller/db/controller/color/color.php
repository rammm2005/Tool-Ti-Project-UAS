<?php

require_once "../../connect.php";


class Color extends Database{

    public function insertColor($id_warna, $nama_warna, $kode_warna, $id_seller) {
        $this->connection->begin_transaction();
    
        try {
            $sql = "INSERT INTO warna(id_warna, nama_warna, kode_warna, id_seller) VALUES ('$id_warna', '$nama_warna', '$kode_warna', '$id_seller')";
    
            if ($this->connection->query($sql)) {
                $this->connection->commit();
                echo "Record added successfully";
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $this->connection->error);
            }
        } catch (Exception $e) {
            $this->connection->rollback();
            die($e->getMessage());
        }
    }
    
    public function editColor($id_warna, $nama_warna, $kode_warna, $id_seller) {
        $this->connection->begin_transaction();

        try {
            // Gunakan query UPDATE untuk melakukan pembaruan
            $sql = "UPDATE warna SET nama_warna = '$nama_warna', kode_warna = '$kode_warna' WHERE id_warna = '$id_warna' AND id_seller = '$id_seller'";

            if ($this->connection->query($sql)) {
                $this->connection->commit();
                echo "Record updated successfully";
            } else {
                throw new Exception("Error: " . $sql . "<br>" . $this->connection->error);
            }
        } catch (Exception $e) {
            $this->connection->rollback();
            die($e->getMessage());
        }
    }


            public function deleteColor($id_warna) {
            $this->connection->begin_transaction();

            try {
                $sql = "DELETE FROM warna WHERE id_warna = ?";

                $stmt = $this->connection->prepare($sql);
                $stmt->bind_param("s", $id_warna);

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