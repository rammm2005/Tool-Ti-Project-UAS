<?php
// delete_image_script.php

require_once('../../connect.php');
require_once('Image.php');

$deletedImage = $_POST['imageIndex'] ?? '';

$image = new Image();
$deleteResult = $image->deleteImage($deletedImage);

// Berikan respons JSON ke JavaScript
header('Content-Type: application/json');

if ($deleteResult) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
