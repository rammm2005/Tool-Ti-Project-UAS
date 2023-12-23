<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}
require_once('../db/connect.php');

function getProduk($userId, $searchQuery = "")
{
    $connection = new Database();

    $sql = "SELECT * FROM produk WHERE id_seller = '" . $_SESSION['user_id'] . "'";

    $result = mysqli_query($connection->getConnection(), $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

// $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$products = getProduk($_SESSION['user_id']);

$succeed = '';
if (isset($_GET['success']) && $_GET['success'] == 'added') {
    $succeed = '
            <div id="regis-success" class="cursor-pointer z-[999] absolute mt-8 left-1/2 transform justify-center flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-full lg:w-[32rem]">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Successfull Added!</span> Your data Has been Added.
            </div>
        </div>      
            ';
}


if (isset($_GET['success']) && $_GET['success'] == 'updated') {
    $succeed = '
            <div id="regis-success" class="cursor-pointer z-[999] absolute mt-8 left-1/2 transform justify-center flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-full lg:w-[32rem]">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Successfull Updated!</span> Your data Has been Update.
            </div>
        </div>      
            ';
}

$failedDel = '';

if (isset($_GET['error']) && $_GET['error'] == 'failedDel') {
    $failedDel = '
         
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Error Delete!</span>  Try again for a few times.
            </div>
        </div>
            ';
}


if (isset($_GET['delete']) && $_GET['delete'] == 'deleted') {
    $failedDel = '
            <div id="regis-success" class="cursor-pointer z-[999] absolute mt-8 left-1/2 transform justify-center flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-full lg:w-[32rem]">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Successfull Delete!</span> Your data Has been Deleted.
            </div>
        </div>      
            ';
}







?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../dist/css/style.css">
    <title>Seller Product</title>
</head>

<body>
    <?php
    include "../src/layout/sidebar_inside.php";
    ?>
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <?php
        include "../src/layout/navbar_inside.php";
        ?>
        <?php
        if (isset($massage)) {
            echo $massage;
        }
        if (isset($succeed)) {
            echo $succeed;
        }

        if (isset($failedDel)) {
            echo $failedDel;
        }
        ?>

        <div id="info-popup" tabindex="-1"
            class="hidden absolute flex items-center justify-center z-[999] w-full h-full md:inset-0">
            <div class="p-4 bg-white rounded-md py-5 px-5 mb-64 shadow dark:bg-gray-800">
                <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                    <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Delete Data</h3>
                    <p>Are you Sure want to Delete the Product Name "<strong id="info-popup-produk-name"></strong>"?</p>
                </div>

                <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                    <div class="items-center justify-end space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                        <button id="close-modal" type="button"
                            class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                        <button id="confirm-button" type="button"
                            class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-red-700 sm:w-auto hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"><i
                                class="ri-delete-bin-2-line"></i> Confirm</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="flex flex-wrap -mx-3 mb-5">
            <div class="w-full max-w-full px-3 mb-6  mx-auto">
                <div
                    class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                    <div
                        class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                        <!-- card header -->
                        <div
                            class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                            <h3
                                class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mr-3 font-semibold text-dark">Product Seller Preview</span>
                                <?php
                                $connection = new Database();
                                $id = $_SESSION['user_id'];

                                $sql = mysqli_query($connection->getConnection(), "SELECT sellername FROM seller WHERE id_seller= '$id' LIMIT 1");
                                $data = mysqli_fetch_array($sql);
                                ?>
                                <span class="mt-1 font-medium text-secondary-dark text-lg/normal">All Product from
                                    <b class="font-bolder text-slate-800 text-sm">
                                        <?php echo $data['sellername']; ?>
                                    </b></span>
                            </h3>


                            <div class="relative flex flex-wrap items-center my-2">
                                <a href="add-produk.php?unique-seller=<?php echo $_SESSION["user_id"]; ?>"
                                    class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-white bg-blue-600 border-light shadow-none border-0 py-2 px-5 hover:bg-blue-700 active:bg-blue-600 focus:bg-blue-600">
                                    Make new Product </a>
                            </div>
                        </div>

                        <!-- end card header -->
                        <!-- card body  -->
                        <div class="flex-auto block py-8  pt-6 px-9">
                            <div class="overflow-x-auto overflow-y-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200" id="myTable">
                                    <thead class="align-bottom">
                                        <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                            <th class="pb-3 text-start min-w-[175px]">Id Produk</th>
                                            <th class="pb-3 text-end min-w-[100px]">Nama Produk</th>
                                            <th class="pb-3 text-end min-w-[100px]">Stok</th>
                                            <th class="pb-3 pr-12 text-end min-w-[175px]">Status</th>
                                            <th class="pb-3 pr-12 text-end min-w-[100px]">Kode Warna</th>
                                            <th class="pb-3 text-end min-w-[50px]">Ukuran</th>
                                            <th class="pb-3 text-end min-w-[50px]">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($products as $product): ?>
                                            <tr class="border-b border-dashed last:border-b-0">
                                                <td class="p-3 pl-0">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col justify-start">
                                                            <a href="javascript:void(0)"
                                                                class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-sm/normal text-secondary-inverse hover:text-primary">
                                                                <?= $product['kode_produk'] ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="p-3 pr-0 text-end">
                                                    <span
                                                        class="font-semibold text-center text-light-inverse text-md/normal">
                                                        <?= $product['nama_produk'] ?>
                                                    </span>
                                                </td>
                                                <td class="p-3 pr-0 text-end">
                                                    <span
                                                        class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                        <?= $product['stok'] ?>
                                                    </span>
                                                </td>
                                                <td class="p-3 pr-12 text-end">
                                                    <?php echo ($product['produk_status'] != 1) ?
                                                        '<button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-md text-sm px-5 py-1.5 text-center me-2 mb-2">Draft</button>' : '<button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-md text-sm px-5 py-1.5 text-center me-2 mb-2">Publish</button>
                                                  ';

                                                    ?>

                                                </td>
                                                <td class="pr-0 text-center">
                                                    <?php
                                                    $sql = mysqli_query($connection->getConnection(), "SELECT kode_warna FROM produk JOIN warna ON produk.id_warna = warna.id_warna WHERE kode_produk = '" . $product['kode_produk'] . "'");
                                                    $warna = mysqli_fetch_array($sql);
                                                    ?>
                                                    <span class="font-semibold text-light-inverse text-md/normal">
                                                        <?= $warna["kode_warna"]; ?> <b
                                                            class="rounded-full w-3 h-3 px-5 py-2 shadow-md"
                                                            style="background-color: <?php echo $warna['kode_warna']; ?>"></b>
                                                    </span>
                                                </td>
                                                <td class="pr-0 text-end items-center">
                                                    <?php
                                                    $sql = mysqli_query($connection->getConnection(), "SELECT besar_ukuran, desk FROM produk JOIN ukuran ON produk.id_ukuran = ukuran.id_ukuran WHERE kode_produk = '" . $product['kode_produk'] . "'");
                                                    $size = mysqli_fetch_array($sql);
                                                    ?>
                                                    <span class="font-semibold text-light-inverse text-md/normal">
                                                        <?= $size["besar_ukuran"]; ?>,
                                                        <?= $size['desk'] ?>
                                                    </span>
                                                </td>

                                                <td class="p-3 pr-0 text-end flex items-center">
                                                    <button
                                                        class="relative text-secondary-dark bg-light-dark hover:text-primary h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 hover:text-red-500 delete-button"
                                                        data-id-produk="<?php echo $product['kode_produk']; ?>"
                                                        data-nama-produk="<?php echo $product['nama_produk']; ?>">
                                                        <span
                                                            class="flex items-center justify-center p-0 m-0 leading-none shrink-0">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </span>
                                                    </button>

                                                    <button
                                                        class="ml-2 relative text-secondary-dark bg-light-dark hover:text-primary h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 hover:text-blue-500">
                                                        <a href="show-produk.php?unique-seller=<?php echo $_SESSION["user_id"]; ?>&product-code=<?php echo $product['kode_produk']; ?>"
                                                            class="flex items-center justify-center p-0 m-0 leading-none shrink-0">
                                                            <i class="ri-search-eye-line"></i>
                                                        </a>
                                                    </button>

                                                    <button
                                                        class="ml-2 relative text-secondary-dark bg-light-dark hover:text-primary h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 hover:text-blue-500">
                                                        <a href="edit-produk.php?unique-seller=<?php echo $_SESSION["user_id"]; ?>&product-code=<?php echo $product['kode_produk']; ?>"
                                                            class="flex items-center justify-center p-0 m-0 leading-none shrink-0">
                                                            <i class="ri-file-edit-line"></i>
                                                        </a>
                                                    </button>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-5">
            <div class="w-full max-w-full sm:w-3/4 mx-auto text-center">
                <p class="text-sm text-slate-500 py-1"> Made By Rama <a class="text-slate-700 hover:text-slate-900"
                        target="_blank">Toko Online</a> by <a href="#" class="text-slate-700 hover:text-slate-900"
                        target="_blank">RaDev</a>. </p>
            </div>
        </div>



    </main>

    <style>
        .paginate_button {
            border: none !important;
            border-radius: 999px;
            padding: .6rem;
        }
    </style>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const infoPopup = document.getElementById('info-popup');
            const closeBtn = document.getElementById('close-modal');
            const confirmBtn = document.getElementById('confirm-button');
            const colorNameElement = document.getElementById('info-popup-produk-name');

            function openPopup(colorName) {
                colorNameElement.textContent = colorName;
                infoPopup.classList.remove('hidden');
            }

            function closePopup() {
                infoPopup.classList.add('hidden');
            }

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const idProduk = button.dataset.idProduk;
                    const namaProduk = button.dataset.namaProduk;

                    openPopup(namaProduk);

                    // Set data attributes for confirmation
                    confirmBtn.dataset.idProduk = idProduk;
                    confirmBtn.dataset.namaProduk = namaProduk;
                });
            });

            confirmBtn.addEventListener('click', function () {
                const idProduk = confirmBtn.dataset.idProduk;
                const namaProduk = confirmBtn.dataset.namaProduk;
                const actionDeleteURL = '../db/controller/product/delete_action.php';

                $.ajax({
                    type: 'POST',
                    url: actionDeleteURL,
                    data: { id_produk: idProduk },
                    success: function (response) {
                        console.log(response);

                        try {
                            const parsedResponse = JSON.parse(response);

                            if (parsedResponse.success) {
                                const sellerId = '<?php echo isset($_SESSION["user_id"]) ? htmlspecialchars($_SESSION["user_id"]) : ""; ?>';
                                window.location.href = `produk.php?unique-seller=${encodeURIComponent(sellerId)}&delete=deleted`;
                            } else {
                                console.error('Failed to mark product as deleted. Error:', parsedResponse.error);
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });

                closePopup();
            });

            closeBtn.addEventListener('click', closePopup);
        });


    </script>

    <script>
        let table = new DataTable('#myTable');
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