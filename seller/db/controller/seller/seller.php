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
        $hassedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        $this->createSeller(
            $id_seller,
            'Default',
            'Seller',
            'default@example.com',
            $hassedPassword,
            'Default Seller create',
            'default.png',
            1
        );
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
