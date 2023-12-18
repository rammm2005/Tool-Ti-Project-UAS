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
            if(isset($_GET['success']) && $_GET['success'] == 'updated'){
            $succeed = '
            <div id="regis-success" class="cursor-pointer absolute mt-8 left-1/2 transform justify-center flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 w-full lg:w-[32rem]">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Successfull Update!</span> Your data was Updated Successfully.
            </div>
        </div>      
            ';
            }

require_once('../db/connect.php');
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


if ($result->num_rows > 0) {
    $sellerData = $result->fetch_assoc();
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="../dist/css/style.css">
        <title>Profile Seller</title>
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

            <div class="container mx-auto my-5 p-5">
                <div class="md:flex no-wrap md:-mx-2 ">
                    <!-- Left Side -->
                    <div class="w-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div class="image overflow-hidden">
                                <img class="h-auto w-full mx-auto"
                                    src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                                    alt="">
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1"></h1>
                            <!-- <h3 class="text-gray-600 font-lg text-semibold leading-6">Owner at Her Company Inc.</h3> -->
                                <?php
                                echo ($sellerData['foto_seller'] != null) ? "<img class='object-contain rounded-lg h-48 w-96' src='../dist/images" .$sellerData['foto_seller'] . "'>" : "<img src='../src/image/default.png' class='object-contain rounded-lg h-48 w-96' />";
                                ?>
                            <p class="text-sm text-gray-500 hover:text-gray-600 leading-6">Ini merupakan halaman Profile
                                seller anda dapat melakukan peningkatan kinerja dan melakukan tindakan update profile disini
                            </p>
                            <ul
                                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Status</span>
                                    <span class="ml-auto"><span
                                            class="bg-green-500 py-1 px-2 rounded text-white text-sm cursor-pointer">
                                            <?=
                                                ($sellerData['status_seller'] == 1) ? 'Active' : 'Inactive';
                                            ?>
                                        </span></span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span class="ml-auto">
                                        <?= date('j F, Y', strtotime($sellerData['created_at'])); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <!-- End of profile card -->
                        <div class="my-4"></div>
                        <!-- Friends card -->

                    </div>
                    <!-- Right Side -->
                    <div class="w-full md:w-9/12 mx-2 h-64">
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">About</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">First Name</div>
                                        <div class="px-4 py-2">
                                            <?php echo ($sellerData['firstname'] == null) ? "-" : $sellerData['firstname']; ?>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Last Name</div>
                                        <div class="px-4 py-2">
                                            <?php echo ($sellerData['lastnama'] == null) ? "-" : $sellerData['lastnama']; ?>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Seller name</div>
                                        <div class="px-4 py-2">
                                            <?php echo $sellerData['sellername'] ?>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Email.</div>
                                        <div class="px-4 py-2">
                                            <a class="text-blue-800" href="mailto:<?php echo $sellerData['email'] ?>">
                                                <?php echo $sellerData['email'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4">Show
                                Full Information</button>
                        </div>
                        <!-- End of about section -->

                        <div class="my-4"></div>

                        <!-- Experience and education -->
                        <div class="bg-white p-3 shadow-md rounded-sm">

                            <form class="py-3 px-3" method="POST"  enctype="multipart/form-data" action="../db/controller/seller/update_action.php">
                            <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information
                                        </h2>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">Isi lah personal info untuk aku penjualan anda untuk meningkatkan penjualan.</p>

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-3">
                                                <label for="first-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">First
                                                    name</label>
                                                <div class="mt-2">
                                                    <input type="text" name="firstname" id="first-name"
                                                        value="<?= $sellerData['firstname'] ?>" 
                                                        autocomplete="given-name"
                                                        class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3">
                                                <label for="last-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Last
                                                    name</label>
                                                <div class="mt-2">
                                                    <input type="text" name="lastnama" id="last-name" value="<?= $sellerData['lastnama'] ?>"
                                                        autocomplete="family-name"
                                                        class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3">
                                                <label for="email"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Email
                                                    address</label>
                                                <div class="mt-2">
                                                    <input id="email" value="<?= $sellerData['email'] ?>" name="email" type="text" autocomplete="email"
                                                    class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>

                                            <div class="sm:col-span-3">
                                                <label for="email"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Fullname
                                                    </label>
                                                <div class="mt-2">
                                                    <input id="fullname" value="<?= $sellerData['sellername'] ?>" name="sellername" type="text" autocomplete="fullname"
                                                    class="block w-full rounded-md border-0 py-2 px-6 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                <div class="space-y-12">
                                    <div class="border-b border-gray-900/10 pb-12">
                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">


                                        <div class="col-span-full">
                                                <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Seller Photo</label>
                                                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                                    <div class="text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                                            aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                            <label for="file-upload"
                                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                                <span id="add-image">Upload a file</span>
                                                                <input id="file-upload" name="foto_seller" type="file" class="sr-only">
                                                            </label>
                                                            <p class="pl-1">or drag and drop</p>
                                                        </div>
                                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG up to 10MB</p>
                                                    </div>
                                                </div>
                                                <div id="image-container" class="mt-2"></div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="reset"
                                        class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                    <button type="submit" name="update_seller"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                </div>
                            </form>
                        </div>
                        <!-- End of profile tab -->
                    </div>
                </div>
            </div>

        </main>

        <?php
} else {

    ?>

        <p class="mb-4 text-lg text-gray-600">Oops! Looks like you're lost.</p>
        <div class="animate-bounce">
            <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
                </path>
            </svg>
        </div>
        <p class="mt-4 text-gray-600">Let's get you back <a href="../index.php" class="text-blue-500">home</a>.</p>
        </div>
        </div>

        <?php
}

$stmt->close();
?>

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