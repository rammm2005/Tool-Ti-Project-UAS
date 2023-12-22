<?php
require_once "../../connect.php";


class Image extends Database {
    public function insertImage($kode_produk, $pondData)
{
    if (!is_array($pondData)) {
        return false;
    }

    $query = "INSERT INTO image (kode_image, image, kode_produk) VALUES (?, ?, ?)";
    $stmt = $this->connection->prepare($query);

    foreach ($pondData['tmp_name'] as $key => $tmp_name) {
        $kode_image = $this->idGenerate();
        $file_name = uniqid() . '_' . basename($pondData['name'][$key]);
        $imagePath = '../../../src/img-produk/' . $file_name;

        // Move the uploaded file to the destination
        if (move_uploaded_file($tmp_name, $imagePath)) {
            // Bind parameters inside the loop
            $stmt->bind_param("sss", $kode_image, $file_name, $kode_produk);
            $stmt->execute();
        } else {
            // Handle file move error
            echo "Error moving uploaded file!";
            return false;
        }
    }

    if ($stmt->errno) {
        // Log MySQL error
        echo "MySQL Error: " . $stmt->error;
    }

    $stmt->close();
    return true;
}

    

    public function idGenerate() {
        $id = '';

        $array = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-";

        for ($i = 0; $i < 10; $i++) {
            $id .= $array[rand(0, strlen($array) - 1)];
        }

        return $id;
    }
}


?>
