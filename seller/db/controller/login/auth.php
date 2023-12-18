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
                $_SESSION['user_id'] = $row['id_seller'];
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
        $checkEmailQuery = "SELECT id_seller FROM seller WHERE email = ?";
        $checkEmailStmt = $this->connection->prepare($checkEmailQuery);
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailResult = $checkEmailStmt->get_result();
    
        if ($checkEmailResult->num_rows > 0) {
            
            return false;
        }
    
        // Proceed with registration
        $hashedPassword = password_hash($passwords, PASSWORD_DEFAULT);
        $status_seller = '1';
        $insertQuery = "INSERT INTO seller (id_seller, email, passwords, sellername, status_seller) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $this->connection->prepare($insertQuery);
        $insertStmt->bind_param("sssss", $id_seller, $email, $hashedPassword, $sellername, $status_seller);
    
        if ($insertStmt->execute()) {
            // Registration successful
            return true;
        } else {
            // Registration failed
            return false;
        }
    }
    

    public function getUserId() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null; 
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
