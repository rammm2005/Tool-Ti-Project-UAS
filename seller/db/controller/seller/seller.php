<?php
require_once '../../connect.php';

class Seller extends Database {
    public function createSeller($id_seller, $firstname, $lastnama, $email, $passwords, $sellername, $foto_seller, $status_seller) {
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        $sql = "INSERT INTO seller (id_seller, firstname, lastnama, email, passwords, sellername, foto_seller, status_seller) VALUES ('$id_seller', '$firstname', '$lastnama', '$email', '$hashedPassword', '$sellername', '$foto_seller', '$status_seller')";

        if ($this->connection->query($sql) === TRUE) {
            echo "Record added successfully";
        } else {
            die("Error: " . $sql . "<br>" . $this->connection->error);
        }
    }

    public function createDefaultSeller() {
        $id_seller = $this->generateIdSeller();
        $passwords = 'defaultsellerpas';
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        $this->createSeller(
            $id_seller,
            'Default',
            'Seller',
            'default@example.com',
            $hashedPassword,
            'Default Seller create',
            'default.png',
            1
        );
    }

    public function updateSeller($id_seller, $firstname, $lastnama, $email, $sellername, $foto_seller) {
        $sql = "UPDATE seller SET firstname = '$firstname', lastnama = '$lastnama', email = '$email', sellername = '$sellername'";
    
        if (!empty($foto_seller['name'])) {
            // Get file details
            $fileName = $foto_seller['name'];
            $fileTmpName = $foto_seller['tmp_name'];
            $fileSize = $foto_seller['size'];
            $fileError = $foto_seller['error'];
            $fileType = $foto_seller['type'];
    
            if ($fileError !== 0) {
                die("File upload error: " . $fileError);
            }
    
            $uploadDir = '../../../dist/images/';
            $uploadPath = $uploadDir . $fileName;
    
            move_uploaded_file($fileTmpName, $uploadPath);
    
            $sql .= ", foto_seller = '$uploadPath'";
        }
    
        $sql .= " WHERE id_seller = '$id_seller'";
    
        if ($this->connection->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            die("Error updating record: " . $this->connection->error);
        }
    }
    
    

    private function generateIdSeller() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $id = '';

        for ($i = 0; $i < 10; $i++) {
            $id .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $id;
    }
}
?>
