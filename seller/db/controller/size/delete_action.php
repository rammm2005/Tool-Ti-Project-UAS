<?php
session_start();
require_once 'size.php'; 

$sizeHandler = new Size();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_ukuran'])) {
    $id_ukuran = $_POST['id_ukuran'];
    $id_seller = $_SESSION['user_id'];

    if (empty($id_ukuran)) {
        header('Location: ../../../produk/size-manage.php?unique-seller=' . $id_seller . '&error=failedDel');
        exit();
    }

    $sizeHandler->deleteSize($id_ukuran);

    header('Location: ../../../produk/size-manage.php?unique-seller=' . $id_seller . '&delete=deleted');
    exit();
}


?>
