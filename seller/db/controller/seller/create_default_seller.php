<?php
require_once "seller.php";

$seller = new Seller();
$seller->createDefaultSeller();

echo "Default seller created successfully!";
?>
