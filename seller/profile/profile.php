<?php
require_once ('../db/connect.php');
$db = new Database();
$uniqueSeller = isset($_GET['unique-seller']) ? $_GET['unique-seller'] : null;

if (!$uniqueSeller) {
    echo "Invalid seller ID.";
    exit();
}

$query = "SELECT * FROM seller WHERE id_seller = ?";
$stmt = $db->getConnection()->prepare($query);
$stmt->bind_param("s", $uniqueSeller);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Seller</title>
</head>
<body>

<?php

if ($result->num_rows > 0) {
    $sellerData = $result->fetch_assoc();

    echo "Seller ID: " . $sellerData['id_seller'] . "<br>";
    echo "Seller Name: " . $sellerData['sellername'] . "<br>";

} else {
    echo "Seller not found.";
}

$stmt->close();
?>
    
</body>
</html>