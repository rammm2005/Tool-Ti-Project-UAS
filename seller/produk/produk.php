<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}
require_once('../db/connect.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
        ?>
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

                                $sql = mysqli_query($connection->getConnection(),"SELECT sellername FROM seller WHERE id_seller= '$id' LIMIT 1");
                                $data = mysqli_fetch_array($sql);
                                ?>
                                <span class="mt-1 font-medium text-secondary-dark text-lg/normal">All Product from 
                               <b class="font-bolder text-slate-800 text-sm"> <?php echo $data['sellername']; ?></b></span>
                            </h3>
                            <div class="relative flex flex-wrap items-center my-2">
                                <a href="insert-produk.php?unique-seller=<?php echo $_SESSION["user_id"]; ?>"
                                    class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-white bg-blue-600 border-light shadow-none border-0 py-2 px-5 hover:bg-blue-700 active:bg-blue-600 focus:bg-blue-600">
                                    Make new Product </a>
                            </div>
                        </div>
                        <!-- end card header -->
                        <!-- card body  -->
                        <div class="flex-auto block py-8 pt-6 px-9">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                    <thead class="align-bottom">
                                        <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                            <th class="pb-3 text-start min-w-[175px]">TASK</th>
                                            <th class="pb-3 text-end min-w-[100px]">OWNER</th>
                                            <th class="pb-3 text-end min-w-[100px]">PROGRESS</th>
                                            <th class="pb-3 pr-12 text-end min-w-[175px]">STATUS</th>
                                            <th class="pb-3 pr-12 text-end min-w-[100px]">DEADLINE</th>
                                            <th class="pb-3 text-end min-w-[50px]">DETAILS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/img-49-new.jpg"
                                                            class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                                                            Social Media API </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal">Olivia
                                                    Cambell</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                    </svg> 6.5% </span>
                                            </td>
                                            <td class="p-3 pr-12 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg">
                                                    In Progress </span>
                                            </td>
                                            <td class="pr-0 text-start">
                                                <span
                                                    class="font-semibold text-light-inverse text-md/normal">2023-08-23</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <button
                                                    class="ml-auto relative text-secondary-dark bg-light-dark hover:text-primary flex items-center h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 justify-center">
                                                    <span
                                                        class="flex items-center justify-center p-0 m-0 leading-none shrink-0 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/img-40-new.jpg"
                                                            class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                                                            Geolocation App </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal">Luca
                                                    Micloe</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-danger bg-danger-light rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                                                    </svg> 2.7% </span>
                                            </td>
                                            <td class="p-3 pr-12 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-light-inverse bg-light rounded-lg">
                                                    Under Review </span>
                                            </td>
                                            <td class="pr-0 text-start">
                                                <span
                                                    class="font-semibold text-light-inverse text-md/normal">2024-04-11</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <button
                                                    class="ml-auto relative text-secondary-dark bg-light-dark hover:text-primary flex items-center h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 justify-center">
                                                    <span
                                                        class="flex items-center justify-center p-0 m-0 leading-none shrink-0 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/img-39-new.jpg"
                                                            class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                                                            iOS Login <span class="text-sm">(Morra)</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal">Bianca
                                                    Winson</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                    </svg> 6.8% </span>
                                            </td>
                                            <td class="p-3 pr-12 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-primary bg-primary-light rounded-lg">
                                                    In Progress </span>
                                            </td>
                                            <td class="pr-0 text-start">
                                                <span
                                                    class="font-semibold text-light-inverse text-md/normal">2024-02-10</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <button
                                                    class="ml-auto relative text-secondary-dark bg-light-dark hover:text-primary flex items-center h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 justify-center">
                                                    <span
                                                        class="flex items-center justify-center p-0 m-0 leading-none shrink-0 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/img-47-new.jpg"
                                                            class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                                                            Axios Menu </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal">Roberto
                                                    Alliton</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-success bg-success-light rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                                    </svg> 4.5% </span>
                                            </td>
                                            <td class="p-3 pr-12 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-success bg-success-light rounded-lg">
                                                    Done </span>
                                            </td>
                                            <td class="pr-0 text-start">
                                                <span
                                                    class="font-semibold text-light-inverse text-md/normal">2023-05-31</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <button
                                                    class="ml-auto relative text-secondary-dark bg-light-dark hover:text-primary flex items-center h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 justify-center">
                                                    <span
                                                        class="flex items-center justify-center p-0 m-0 leading-none shrink-0 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                    <div class="relative inline-block shrink-0 rounded-2xl me-3">
                                                        <img src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/riva-dashboard-tailwind/img/img-48-new.jpg"
                                                            class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl"
                                                            alt="">
                                                    </div>
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-lg/normal text-secondary-inverse hover:text-primary">
                                                            Resto Aperto </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal">Michael
                                                    Kenny</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-2 py-1 mr-auto items-center font-semibold text-base/none text-danger bg-danger-light rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                                                    </svg> 1% </span>
                                            </td>
                                            <td class="p-3 pr-12 text-end">
                                                <span
                                                    class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-warning bg-warning-light rounded-lg">
                                                    Postponed </span>
                                            </td>
                                            <td class="pr-0 text-start">
                                                <span
                                                    class="font-semibold text-light-inverse text-md/normal">2023-05-15</span>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <button
                                                    class="ml-auto relative text-secondary-dark bg-light-dark hover:text-primary flex items-center h-[25px] w-[25px] text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-200 ease-in-out shadow-none border-0 justify-center">
                                                    <span
                                                        class="flex items-center justify-center p-0 m-0 leading-none shrink-0 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
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
                <p class="text-sm text-slate-500 py-1"> Made By Rama <a
                       
                        class="text-slate-700 hover:text-slate-900" target="_blank">Toko Online</a> by <a
                        href="#" class="text-slate-700 hover:text-slate-900"
                        target="_blank">RaDev</a>. </p>
            </div>
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

    
</body >
</html >