<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}
require_once('../db/connect.php');


$message = '';

if (isset($_GET['error']) && $_GET['error'] === 'missing_fields') {
    $message = '<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Data Error and Null !</strong>
            <span class="block sm:inline">Please make sure your Size is Field.</span>
            <span class="absolute top-0 bottom-0 right-[-7px] px-4 py-3" id="err-alert" >
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>';
}

$messages = '';

if (isset($_GET['error']) && $_GET['error'] === 'eror_insert') {
    $messages = '<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Data Error and Null !</strong>
            <span class="block sm:inline">Please make sure your Size is Field.</span>
            <span class="absolute top-0 bottom-0 right-[-7px] px-4 py-3" id="err-alert" >
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>';
}

$no_data_upload = '';

if (isset($_GET['error']) && $_GET['error'] === 'no_img_upload') {
    $no_data_upload = '<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Data Error and Null !</strong>
            <span class="block sm:inline">Please make sure your Size is Field.</span>
            <span class="absolute top-0 bottom-0 right-[-7px] px-4 py-3" id="err-alert" >
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>';
}



function getSizesByUser($user_id)
{
    $connection = new Database();

    $query = "SELECT id_ukuran, besar_ukuran FROM ukuran WHERE id_seller = ?";
    $stmt = $connection->getConnection()->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sizes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $sizes;
}

function getColorsByUser($user_id)
{
    $connection = new Database();

    $query = "SELECT id_warna, nama_warna FROM warna WHERE id_seller = ?";
    $stmt = $connection->getConnection()->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $colors = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $colors;
}


$user_id = $_SESSION['user_id'];

$sizes = getSizesByUser($user_id);
$colors = getColorsByUser($user_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../dist/css/style.css">
    <link rel="stylesheet" href="../dist/css/main.css">
    <title>Add Product</title>
</head>

<body>

    <?php include "../src/layout/sidebar_inside.php"; ?>

    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <?php include "../src/layout/navbar_inside.php"; ?>

        <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($messages)) {
            echo $messages;
        }
        if (isset($message)) {
            echo $message;
        }
        ?>

        <div class="px-4 px-4 mb-4">
            <div class="bg-white p-3 shadow-md rounded-sm">
                <form class="py-3 px-3" id="my-form" method="POST"  action="../db/controller/product/insert_action.php"
                enctype="multipart/form-data">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Tambahkan Produk baru</h2>
                        <p class="mt-1 text-sm leading-6 text-gray-600">Tambahkan Produk baru untuk meningkatkan
                            penjualan anda.</p>



                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Name</label>
                                <div class="mt-2">
                                    <input type="text" name="nama_produk" id="nama" placeholder="Product name"
                                        autocomplete="family-name"
                                        class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="stok"
                                    class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                                <div class="mt-2">
                                    <input type="number" name="stok" id="stok" placeholder="100 or 200"
                                        autocomplete="family-name"
                                        class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                        </div>


                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="size" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Size</label>
                                <div class="mt-2">
                                    <select multiple id="size" name="id_ukuran[]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled>Choose Size</option>

                                        <?php foreach ($sizes as $size): ?>
                                            <option value="<?= $size['id_ukuran'] ?>">
                                                <?= $size['besar_ukuran'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="color" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Color</label>
                                <div class="mt-2">
                                    <select multiple id="coloe" name="id_warna[]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled>Choose Color</option>
                                        <?php foreach ($colors as $color): ?>
                                            <option value="<?= $color['id_warna'] ?>">
                                                <?= $color['nama_warna'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>



                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="desk" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Price</label>
                                <div class="mt-2">
                                    <div class="relative">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2.5 text-gray-500">
                                            $</div>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
                                            RP</div>
                                        <input type="text" id="example6"
                                            class="block w-full rounded-md py-2 shadow-sm ring-1 ring-inset ring-gray-300 px-6 border-gray-300 px-8 shadow-sm focus:border-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                                            placeholder="0.00" name="harga" />
                                    </div>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Select
                                    Product Status</label>
                                <div class="mt-2">
                                    <select id="status" name="produk_status"
                                        class="block w-full rounded-md border-0 bg-white py-3 font-bolder text-base px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option selected disabled>Choose a Status</option>
                                        <option value="1">Publish</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="desk" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Deskripsion</label>
                                <div class="mt-2">
                                    <textarea name="desk" id="desk" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="spesifikasi"
                                    class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                                <div class="mt-2">
                                    <textarea name="spesifikasi" id="spesifikasi" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <h2 class="text-base font-semibold leading-7 text-gray-900">Foto Produk</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Tambahkan Produk baru untuk meningkatkan
                        kualitas dan keindahan produk anda.</p>

                    <div class="mt-10 grid grid-cols-1 h-full gap-x-6 gap-y-8 sm:grid-cols-1">
                        <div class="sm:col-span-3 h-full">
                            <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Product
                                Image</label>
                                <div class="multiple-uploader" id="multiple-uploader">
                                    <div class="mup-msg">
                                        <span class="mup-main-msg">click to upload images.</span>
                                        <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span>
                                        <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>
                                    </div>
                                </div>
                        </div>



                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <button type="button" onclick="window.history.back(-1)"
                                    class="text-sm font-semibold leading-6 text-gray-900">Back</button>
                                <button type="submit" id="submitBtn"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                            </div>
                </form>
            </div>
        </div>
    </main>


    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script src="../dist/js/script.js"></script>
    <script src="../dist/js/multiple-uploader.js"></script>
    <script>
    let multipleUploader = new MultipleUploader('#multiple-uploader').init({
        maxUpload : 20, // maximum number of uploaded images
        maxSize:2, // in size in mb
        filesInpName: 'file',
        formSelector: '#my-form', // form selector
    });
    </script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: "list",
        });
    </script>


   

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const errAlertToggle = document.querySelector('#err-alert');
            const errAlert = document.querySelector('#alert');
            const alertNotif = document.getElementById('regis-success');
            if (errAlertToggle && errAlert) {
                errAlertToggle.addEventListener('click', function () {
                    errAlert.style.opacity = '0';
                    errAlert.style.transition = 'all ease 1s';

                    setTimeout(function () {
                        errAlert.style.display = 'none';
                    }, 1000);
                });
            }
            if (alertNotif) {
                alertNotif.style.transition = 'transform 0.5s, opacity 0.5s';
                alertNotif.style.transform = 'translate(-50%)';
                alertNotif.style.opacity = '1';

                setTimeout(() => {
                    alertNotif.style.transform = 'translateX(0%)';
                    alertNotif.style.opacity = '0';

                    setTimeout(() => {
                        alertNotif.remove();
                    }, 500);
                }, 12000);
            }
        });
    </script>

</body>

</html>