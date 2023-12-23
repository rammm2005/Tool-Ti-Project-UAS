<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login/login.php");
  exit();
}
require_once('../db/connect.php');

function getProduk($userId, $kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT * FROM produk WHERE id_seller = '" . $userId . "' AND kode_produk = '" . $kodeProduk . "'");
  $data = [];
  while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
  }
  return $data;
}


function getImage($kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT * FROM image WHERE kode_produk = '" . $kodeProduk . "'");
  $data = [];
  while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
  }
  return $data;
}


function getImage1($kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT * FROM image WHERE kode_produk = '" . $kodeProduk . "' LIMIT 1");
  $data = mysqli_fetch_assoc($sql);

  return $data;
}

function getName($userId, $kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT * FROM produk WHERE id_seller = '" . $userId . "' AND kode_produk = '" . $kodeProduk . "'");

  $data = mysqli_fetch_assoc($sql);

  return $data;
}

function getSize($kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT id_ukuran FROM produk WHERE kode_produk = '" . $kodeProduk . "'");

  $result_produk = mysqli_fetch_assoc($sql);

  if (!$result_produk) {
    return null;
  }

  $id_ukuran = $result_produk['id_ukuran'];
  $sql = mysqli_query($connection->getConnection(), "SELECT besar_ukuran, desk FROM ukuran WHERE id_ukuran = '" . $id_ukuran . "'");
  $result_ukuran = mysqli_fetch_assoc($sql);

  $data = array_merge($result_produk, $result_ukuran);

  return $data;
}

function getColor($kodeProduk)
{
  $connection = new Database();

  $sql = mysqli_query($connection->getConnection(), "SELECT id_warna FROM produk WHERE kode_produk = '" . $kodeProduk . "'");
  $result_produk = mysqli_fetch_assoc($sql);

  if (!$result_produk) {
    return null;
  }

  $id_warna = $result_produk['id_warna'];
  $sql = mysqli_query($connection->getConnection(), "SELECT nama_warna, kode_warna FROM warna WHERE id_warna = '" . $id_warna . "'");
  $result_warna = mysqli_fetch_assoc($sql);

  $data = array_merge($result_produk, $result_warna);

  return $data;
}




function getSeller($userId, $kodeProduk)
{
  $connection = new Database();
  $sql = mysqli_query($connection->getConnection(), "SELECT sellername FROM seller WHERE id_seller= '" . $userId . "' LIMIT 1");

  $data = mysqli_fetch_assoc($sql);

  return $data;
}

$kodeProduk = $_GET['product-code'];
$products = getProduk($_SESSION['user_id'], $kodeProduk);
$images = getImage($kodeProduk);
$product = getName($_SESSION['user_id'], $kodeProduk);
$image = getImage1($kodeProduk);

$getSeller = getSeller($_SESSION['user_id'], $kodeProduk);

$color = getColor($kodeProduk);
$size = getSize($kodeProduk);
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <link rel="stylesheet" href="../dist/css/style.css">
  <title>Product
    <?php echo isset($product['nama_produk']) ? htmlspecialchars($product['nama_produk']) : 'Untitled Product'; ?>
  </title>
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



    <section class="py-12 sm:py-16">
      <div class="container mx-auto px-4">
        <nav class="flex">
          <ol role="list" class="flex items-center">
            <li class="text-left">
              <div class="-m-1">
                <a href="../index.php"
                  class="rounded-md p-1 text-sm font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800">
                  home </a>
              </div>
            </li>

            <li class="text-left">
              <div class="flex items-center">
                <span class="mx-2 text-gray-400">/</span>
                <div class="-m-1">
                  <a href="produk.php"
                    class="rounded-md p-1 text-sm font-medium text-gray-600 focus:text-gray-900 focus:shadow hover:text-gray-800">
                    Products </a>
                </div>
              </div>
            </li>

            <li class="text-left">
              <div class="flex items-center">
                <span class="mx-2 text-gray-400">/</span>
                <div class="-m-1">
                  <a href="#"
                    class="rounded-md p-1 text-sm font-bold text-gray-700 focus:text-gray-900 focus:shadow hover:text-gray-800"
                    aria-current="page">
                    <?php echo isset($product['nama_produk']) ? htmlspecialchars($product['nama_produk']) : 'Untitled Product'; ?>
                  </a>
                </div>
              </div>
            </li>
          </ol>
        </nav>

        <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
          <div class="lg:col-span-3 lg:row-end-1">
            <div class="lg:flex lg:items-start">
              <div class="lg:order-2 lg:ml-5">
                <div class="max-w-xl overflow-hidden rounded-lg img-fluid">
                  <img id="previewImage" src="../src/img-produk/<?= $images[0]['image'] ?>"
                    alt="<?= $images[0]['kode_image'] ?>">
                </div>
              </div>

              <div class="mt-2 w-full lg:order-1 lg:w-32 lg:flex-shrink-0">
                <div class="flex flex-row items-start lg:flex-col">

                  <?php foreach ($images as $image): ?>
                    <button type="button" data-index="<?= $image['kode_image'] ?>"
                      class="flex-0 thumbnail-button aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-gray-900 text-center">
                      <img class="h-full w-full object-cover" src="../src/img-produk/<?= $image['image'] ?>"
                        alt="<?= $image['kode_image'] ?>" />
                    </button>
                  <?php endforeach; ?>

                </div>
              </div>
            </div>
          </div>

          <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
            <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl">
              <?= $product['nama_produk'] ?>
            </h1>

            <div class="mt-5 flex items-center">
              <div class="flex items-center">
                <i class="ri-admin-line"></i>
              </div>
              <p class="ml-2 text-sm font-medium text-gray-500"><b class="font-bold text-gray-700">
                  <?= $getSeller['sellername'] ?>
                </b></p>
            </div>

            <h2 class="mt-8 text-md font-bold text-gray-900">Size</h2>
            <div class="mt-3 flex select-none flex-wrap items-center gap-1">
              <?= $size['besar_ukuran'] ?>
              <label class="">
                <input type="radio" name="type" value="Powder" class="peer sr-only" checked />
                <p
                  class="peer-checked:bg-black peer-checked:text-white rounded-lg border border-black px-6 py-2 font-bold">
                  <?= $size['desk'] ?>
                </p>
              </label>
            </div>

            <h2 class="mt-8 text-md font-bold text-gray-900">Color</h2>
            <div class="mt-3 flex select-none flex-wrap items-center gap-1">
              <label class="flex flex-row items-center text-center gap-4">
                <input type="radio" name="subscription" value="4 Months" class="peer sr-only" />
                <p
                  class="peer-checked:bg-black peer-checked:text-white flex flex-row rounded-lg border border-black px-6 py-2 font-bold">
                  <?= $color['nama_warna'] ?> <span class="mt-1 block text-center text-xs">
                </p>

                <span class="font-semibold flex gap-2 items-center text-center text-light-inverse text-md/normal">
                  <?= $color["kode_warna"]; ?> <b class="rounded-full w-5 h-5 px-5 py-5 shadow-md"
                    style="background-color: <?php echo $color['kode_warna']; ?>"></b>
                </span></span>

              </label>
            </div>

            <div
              class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
              <div class="flex items-end">
                <h1 class="text-3xl font-bold">
                  <?php
                  if (isset($product['harga'])) {
                    $hargaRupiah = "Rp " . number_format($product['harga'], 0, ',', '.');
                    echo $hargaRupiah;
                  } else {
                    echo "Price not available";
                  }
                  ?>
                </h1>
                <span class="text-base">/Product</span>
              </div>
            </div>

            <button type="button"
              class="inline-flex items-center justify-center rounded-md border-2 border-transparent bg-gray-900 bg-none px-12 py-3 text-center text-base font-bold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
              <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
              Add to cart
            </button>
          </div>

        </div>

        <div class="lg:col-span-3">
          <div class="border-b border-gray-300 gap-3 flex">
            <a href="javascript:void()" id="descriptionLink"
              class="nav-link border-b-2 border-gray-900 py-4 text-md font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800"
              onclick="showContent('description')">Description</a>
            <a href="javascript:void()" id="reviewsLink"
              class="nav-link inline-flex items-center border-b-2 py-4 text-md font-medium text-gray-600"
              onclick="showContent('reviews')">Spesifikasi <span
                class="ml-2 block rounded-full bg-gray-500 px-2 py-px text-xs font-bold text-gray-100"></span></a>

          </div>
          <div id="descriptionContent" class="mt-8 flow-root stroke-linecap sm:mt-12">
            <?= $product['deskripsi'] ?>
          </div>
          <div id="reviewsContent" class="hidden mt-8 stroke-linecap flow-root sm:mt-12">
            <?= $product['spesifikasi'] ?>
          </div>
        </div>
      </div>
      </div>
    </section>



    <div class="flex flex-wrap -mx-3 mb-5">
      <div class="w-full max-w-full px-3 mb-6  mx-auto">
        <div
          class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
          <div
            class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
            <!-- card header -->
            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
              <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
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

            <div class="flex-auto block py-8  pt-6 px-9">
              <div class="overflow-x-auto overflow-y-auto">
                <table class="w-full my-0 align-middle text-dark border-neutral-200">
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
                          <span class="font-semibold text-center text-light-inverse text-md/normal">
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
                            <?= $warna["kode_warna"]; ?> <b class="rounded-full w-3 h-3 px-5 py-2 shadow-md"
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

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../dist/js/script.js"></script>

  <script>
    function showContent(contentType) {
      document.getElementById('descriptionContent').style.display = 'none';
      document.getElementById('reviewsContent').style.display = 'none';

      const links = document.querySelectorAll('.nav-link');
      links.forEach(link => link.classList.remove('border-b-2', 'border-gray-900'));

      document.getElementById(contentType + 'Content').style.display = 'block';

      const clickedLink = document.getElementById(contentType + 'Link');
      clickedLink.classList.add('border-b-2', 'border-gray-900');
    }

  </script>


  <script>
   $(document).ready(function () {
        $('.thumbnail-button').on('click', function () {
            var imageUrl = $(this).find('img').attr('src');
            $('#previewImage').attr('src', imageUrl);
            zoomImage();
        });

        // Zoom functionality
        function zoomImage() {
            var imgContainer = $('.img-container');
            var img = $('#previewImage');
            var containerWidth = imgContainer.width();
            var containerHeight = imgContainer.height();
            var imgWidth = img.width();
            var imgHeight = img.height();

            var scaleX = containerWidth / imgWidth;
            var scaleY = containerHeight / imgHeight;
            var scale = Math.min(scaleX, scaleY);

            img.css({
                'transform': 'scale(' + scale + ')',
                'transformOrigin': 'top left'
            });
        }
    });



  </script>


</body>

</html>