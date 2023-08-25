<?php
require 'connection.php';
$queryProduk = mysqli_query($con, "SELECT id, nama,harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuliner Desa Teniga | Home</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="fontawesome/css/all.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php require 'navbar.php' ?>

  <!-- banner -->
  <div class="container-fluid banner d-flex align-items-center">
    <div class="container text-center">
      <h1>Kuliner <span>Desa</span> Teniga</h1>
      <h3>Mau Cari Apa?</h3>
      <div class="col-md-8 offset-md-2">
        <form action="produk.php" method="get">
          <div class="input-group input-group-lg my-4">
            <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Recipient's username"
              aria-describedby="basic-addon2" name="keyword">
            <button type="submit" class="btn warna1 text-white">Telusuri</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- tentang kami -->
  <section id="about" class="about">
    <h2><span>Tentang</span> Kami</h2>

    <div class="row ">
      <div class="content text-center">
        <h3>Kenapa Harus Belanja Di UMKM Desa Teniga?</h3>
        <p>Market digital Desa Teniga diniatan sebagai wadah untuk mempromosikan hasil produk UMKM yang ada di Desa
          Teniga.</p>
        <p>Untuk membantu dan mendukung perputaran perekonomian masyarakat Desa Teniga</p>
      </div>
    </div>
  </section>
  <!-- About Section End -->

  <!-- kategori -->
  <div class="container-fluid py-5">
    <div class="container text-center">
      <h2><span>Kategori</span> Kami</h2>

      <div class="row mt-5 justify-content-center">
        <div class="col-md-3 mb-3">
          <div class="highlighted-kategori ktg-makanan d-flex justify-content-center align-items-center">
            <h4><a class="no-decoration btn btn-outline-warning" href="produk.php?kategori=Makanan">Makanan</a></h4>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="highlighted-kategori ktg-minuman d-flex justify-content-center align-items-center">
            <h4><a class="no-decoration btn btn-outline-warning" href="produk.php?kategori=Minuman">Minuman</a></h4>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="highlighted-kategori ktg-anyaman d-flex justify-content-center align-items-center">
            <h4><a class="no-decoration btn btn-outline-warning" href="produk.php?kategori=Anyaman">Anyaman</a>
            </h4>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="highlighted-kategori ktg-hiasan d-flex justify-content-center align-items-center">
            <h4><a class="no-decoration btn btn-outline-warning" href="produk.php?kategori=Hiasan">Hiasan</a></h4>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- produk -->
  <div class="container-fluid py-5">
    <div class="container text-center">
      <h2>Produk Uggulan <span>Kami</span></h2>
      <div class="row mt-5">
        <?php while ($data = mysqli_fetch_array($queryProduk)) {

          ?>
          <div class="col-sm-6 col-md-4 mb-5">
            <div class="card produk-card h-100">
              <div class="image-box">
                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="..">
              </div>
              <div class="card-body">
                <h4 class="card-title">
                  <?php echo $data['nama']; ?>
                </h4>
                <p class="card-text text-truncate">
                  <?php echo $data['detail']; ?>
                </p>
                <p class="card-text text-harga">Rp.
                  <?php echo $data['harga']; ?>
                </p>
                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna1">Lihat Detail</a>
              </div>
            </div>
          </div>
        <?php }
        ?>
      </div>
      <a href="produk.php" class="btn btn-outline-warning mt-3 p-3 fs-3">See More</a>
    </div>
  </div>

  <!-- Contact Section Start -->
  <section id="content" class="content">
    <h2 class="text-center mt-5"><span>Peta</span> Kami</h2>
    <p class="text-center">Berikut ini adalah peta Desa Teniga</p>

    <div class="row">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d785.4366959942608!2d116.14259017889354!3d-8.41767121772202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcddb35e492120b%3A0x3795091d35cf9fa8!2sKantor%20Kepala%20Desa%20Teniga!5e1!3m2!1sid!2sid!4v1691682059780!5m2!1sid!2sid"
        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>


    </div>
  </section>
  <!-- Contact Section End -->

  <?php require 'footer.php' ?>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="fontawesome/js/all.min.js"></script>
</body>

</html>