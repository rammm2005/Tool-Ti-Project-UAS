<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}
require_once('../db/connect.php');

            $succeed ='';
            if(isset($_GET['success']) && $_GET['success'] == 'added'){
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
            function getColorData($userId) {
                $connection = new Database();
                $sql = mysqli_query($connection->getConnection(), "SELECT * FROM warna ");
                $data = [];
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
                return $data;
            }
            $colorData = getColorData($_SESSION['user_id']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../dist/css/style.css">
    <title>Color Manager</title>
</head>

<body>
<?php
        include "../src/layout/sidebar_inside.php";
        ?>
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <?php
        include "../src/layout/navbar_inside.php";
        ?>
       
        <div class="flex flex-wrap -mx-3 mb-5">
        <?php
        
        if (isset($succeed)) {
            echo $succeed;
        }
        ?>
        
            <div class="w-full max-w-full px-3 mb-6  mx-auto">
                <div
                    class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                    <div
                        class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                        <div
                            class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                            <h3
                                class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mr-3 font-semibold text-dark">Color Manager Preview</span>
                                <?php
                                $connection = new Database();
                                $id = $_SESSION['user_id'];

                                $sql = mysqli_query($connection->getConnection(),"SELECT sellername FROM seller WHERE id_seller= '$id' LIMIT 1");
                                $data = mysqli_fetch_array($sql);
                                ?>
                                <span class="mt-1 font-medium text-secondary-dark text-lg/normal">All Color from 
                               <b class="font-bolder text-slate-800 text-sm"> <?php echo $data['sellername']; ?></b></span>
                            </h3>
                            <div class="relative flex flex-wrap items-center my-2">
                                <a href="add-color.php?unique-seller=<?php echo $_SESSION["user_id"]; ?>"
                                    class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-white bg-blue-600 border-light shadow-none border-0 py-2 px-5 hover:bg-blue-700 active:bg-blue-600 focus:bg-blue-600">
                                    Make new Color </a>
                            </div>
                        </div>
                        <div class="flex-auto block py-8 pt-6 px-9">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                    <thead class="align-bottom">
                                        <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                            <th class="pb-3 text-start text-blue-600 min-w-[175px]">Kode Warna</th>
                                            <th class="pb-3 text-end min-w-[100px]">Warna</th>
                                            <th class="pb-3 text-end min-w-[50px]">Acions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($colorData as $color): ?>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex items-center">
                                                
                                                    <div class="flex flex-col justify-start">
                                                        <a href="javascript:void(0)"
                                                            class="mb-1 font-semibold transition-colors duration-200 ease-in-out text-md/normal text-secondary-inverse hover:text-primary">
                                                            <?php echo $color['id_warna'];?> </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-end">
                                                <span class="font-semibold text-light-inverse text-md/normal"><?php echo $color['nama_warna'];?></span>
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
            const alertNotif = document.getElementById('regis-success');
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