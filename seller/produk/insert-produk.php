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
            <span class="block sm:inline">Please make sure you filled all the input.</span>
            <span class="absolute top-0 bottom-0 right-[-7px] px-4 py-3" id="err-alert" >
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>';
            }
            $succeed ='';
            if(isset($_GET['success']) && $_GET['success'] == 'added'){
            $succeed = '
            <div id="regis-success" class="cursor-pointer absolute mt-8 left-1/2 transform justify-center flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-full lg:w-[32rem]">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Successfull Create!</span> New product was Created.
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
        <link rel="stylesheet" href="../dist/css/style.css">
        <title>Tambah Produk</title>
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
                if(isset($massage)){
                   echo $massage;
                }
                 if(isset($succeed)){
                   echo $succeed;
                }
            ?>

          

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