<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}

$massage = '';
if (isset($_GET['error']) && $_GET['error'] === 'missing_fields') {
    $massage = '<div id="alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Data Error and Null !</strong>
            <span class="block sm:inline">Please make sure your Color is Field.</span>
            <span class="absolute top-0 bottom-0 right-[-7px] px-4 py-3" id="err-alert" >
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../dist/css/style.css">
    <title>Add Color</title>
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
       
        ?>

        <div class="bg-white p-3 shadow-md rounded-sm">

            <form class="py-3 px-3" method="POST"
                action="../db/controller/color/insert_action.php">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Tambahkan Warna baru
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Tambahkan Warna baru untuk menambahkan warna produk anda.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Add Color</label>
                            <div class="mt-2">
                                <input type="text" name="nama_warna" id="nama" placeholder="gray or pink"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>


                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                        <button type="submit" name="add-warna"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
            </form>
        </div>



    </main>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileUpload = document.getElementById('file-upload');
            const addImage = document.getElementById('add-image');
            const imageContainer = document.getElementById('image-container');

            fileUpload.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Uploaded Image';
                        img.className = 'mt-2 rounded-md max-w-full h-auto';
                        imageContainer.innerHTML = ''; // Clear previous images
                        imageContainer.appendChild(img);
                        addImage.innerText = 'Change Image';
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

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