<?php
require 'connection.php';

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
$produkTerkait = mysqli_fetch_array($queryProdukTerkait);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuliner Desa Teniga | Detail Produk </title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<style>
  .produk-terkait-image {
    transition: transform 0.3s;
    /* Menambahkan efek transisi */
  }

  .produk-terkait-image:hover {
    transform: scale(1.1);
    /* Efek perbesaran ketika kursor diarahkan */
  }
</style>
</head>

<body>
  <?php require 'navbar.php' ?>

  <!-- Detail Produk -->
  <div class="container-fluid py-5 ">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mb-4 mt-4">
          <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
        </div>
        <div class="col-lg-6 offset-lg-1 mt-4">
          <h1>
            <?php echo $produk['nama']; ?>
          </h1>
          <p class="fs-5">
            <?php echo $produk['detail']; ?>
          </p>
          <p class="text-harga">Rp.
            <?php echo $produk['harga']; ?>
          </p>
          <p class="fs-5">Status Keterangan : <strong>
              <?php echo $produk['stok']; ?>
            </strong></p>
          <a href="https://api.whatsapp.com/send?phone=6287858943434" class="btn btn-wa"
            style="background-color: #b6895b;">
            Pesan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- produk terkait -->
  <div class="container-fluid py-5">
    <div class="container">
      <h2 class="text-center text-withe">Produk Terkait</h2>

      <div class="row">
        <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
          <div class="col-md-6 col-lg-3 mb-3">
            <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
              <img src="image/<?php echo $data['foto'] ?>" alt="" class="img-fluid img-thumbnail produk-terkait-image">
            </a>
          </div>

        <?php } ?>
      </div>
    </div>
  </div>


  <?php require 'footer.php' ?>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="fontawesome/js/all.min.js"></script>
</body>

</html>