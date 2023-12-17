<?php
require_once '../../connect.php';

class Auth extends Database {
    public function login($email, $password) {
        $sql = "SELECT id_seller, email, passwords FROM seller WHERE email = '$email' AND status_seller = '1'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['passwords'];

            if (password_verify($password, $hashedPassword)) {
                // return $row['id_seller'];
                return true;
            } else {
                // Invalid password
                return false;
            }
        } else {
            // User not found
            return false;
        }
    }

    public function register($id_seller, $email, $sellername, $passwords, $status_seller) {
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        $status_seller = '1';
        $sql = "INSERT INTO seller (id_seller, email, passwords, sellername, status_seller) VALUES ('$id_seller', '$email', '$hashedPassword', '$sellername', '$status_seller')";

        if ($this->connection->query($sql) === TRUE) {
            // Registration successful
            return true;
        } else {
            // Registration failed
            return false;
        }
    }


    public function generateIdSeller() {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $id = '';

        for ($i = 0; $i < 10; $i++) {
            $id .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $id;
    }
}
?>
