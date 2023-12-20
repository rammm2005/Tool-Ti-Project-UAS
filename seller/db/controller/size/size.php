<?php

require_once "../../connect.php";


class Size extends Database{

    public function insertSize($id_ukuran, $besar_ukuran, $id_seller, $desk) {
        $this->connection->begin_transaction();
    
        try {
            $sql = "INSERT INTO ukuran(id_ukuran, besar_ukuran, id_seller, desk) VALUES ('$id_ukuran', '$besar_ukuran', '$id_seller', '$desk')";
    
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


    public function updateSize($id_ukuran, $besar_ukuran, $id_seller, $desk) {
        $this->connection->begin_transaction();

        try {
            $sql = "UPDATE ukuran SET besar_ukuran = '$besar_ukuran', desk = '$desk' WHERE id_ukuran = '$id_ukuran' AND id_seller = '$id_seller'";

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
    

    public function deleteSize($id_ukuran) {
        $this->connection->begin_transaction();

        try {
            $sql = "DELETE FROM ukuran WHERE id_ukuran = ?";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("s", $id_ukuran);

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