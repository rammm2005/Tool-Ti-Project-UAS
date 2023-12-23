<?php
require_once "../../connect.php";

class Image extends Database
{
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

            if (move_uploaded_file($tmp_name, $imagePath)) {
                $stmt->bind_param("sss", $kode_image, $file_name, $kode_produk);
                $stmt->execute();
            } else {
                echo "Error moving uploaded file!";
                return false;
            }
        }

        if ($stmt->errno) {
            echo "MySQL Error: " . $stmt->error;
        }

        $stmt->close();
        return true;
    }

    public function deleteImages($kode_produk)
    {
        $query = "SELECT kode_image FROM image WHERE kode_produk = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $kode_produk);
        $stmt->execute();
        $stmt->bind_result($kode_image);

        $kode_images = array();
        while ($stmt->fetch()) {
            $kode_images[] = $kode_image;
        }

        $stmt->close();

        // Delete each image
        foreach ($kode_images as $kode_image) {
            $this->deleteImage($kode_image);
        }
    }

            public function deleteImage($kode_image)
        {
            $query = "SELECT image FROM image WHERE kode_image = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $kode_image);
            $stmt->execute();
            $stmt->bind_result($file_name);

            // Check if a row is fetched
            if ($stmt->fetch()) {
                // $stmt->close();  // Remove this line

                $stmt->close(); // Close the statement here

                $query = "DELETE FROM image WHERE kode_image = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("s", $kode_image);
                $stmt->execute();
                $stmt->close();

                $imagePath = '../../../src/img-produk/' . $file_name;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    return true;
                }
            } else {
                $stmt->close(); // Close the statement in case of no row fetched
                return false;
            }

            return false;
        }




    public function updateImages($kode_produk, $pondData)
    {
        if (!is_array($pondData)) {
            return false;
        }

        $this->deleteImages($kode_produk);

        return $this->insertImage($kode_produk, $pondData);
    }



    public function idGenerate()
    {
        $id = '';
        $array = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_-";

        for ($i = 0; $i < 10; $i++) {
            $id .= $array[rand(0, strlen($array) - 1)];
        }

        return $id;
    }
}
?>