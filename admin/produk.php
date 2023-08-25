<?php
require "session.php";
require '../connection.php';

$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($query);

$querykategori = mysqli_query($con, "SELECT * FROM kategori");

function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[random_int(0, $charactersLength - 1)];
  }
  return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head content... -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

  <style>
    .no-decoration {
      text-decoration: none;
    }

    form div {
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-5">
    <nav aria-label="breadcrumb">
      <!-- Breadcrumb content... -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"> <a href="../admin" class="no-decoration text-muted"><i
              class="fas fa-home"></i> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-box"></i> Produk</li>
      </ol>
    </nav>

    <!-- Tambah produk -->
    <div class="my-5 col-12 col-md-6">
      <h3>Tambah Produk</h3>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="">
          <label for="nama">
            Nama
            <input type="text" name="nama" id="nama" class="form-control" autocomplete="off">
          </label>
        </div>
        <div class="">
          <label for="kategori">Kategori
            <select name="kategori" id="kategori" class="form-control" required>
              <option value="">---Pilih Kategori---</option>
              <?php
              while ($data = mysqli_fetch_array($querykategori)) {
                ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                <?php
              }
              ?>
            </select>
          </label>
        </div>
        <div class="">
          <label for="harga">
            Harga
            <input type="number" name="harga" class="form-control" required>
          </label>
        </div>
        <div class="">
          <label for="gambar">
            Gambar
            <input type="file" name="gambar" class="form-control" id="gambar">
          </label>
        </div>

        <div class="">
          <label>
            Detail
            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
          </label>
        </div>

        <div class="">
          <label for="ketersediaan_stok">
            Kategori Stok
            <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
              <option value="tersedia">Tersedia</option>
              <option value="Habis">Habis</option>
            </select>
          </label>
        </div>
        <div class="">
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
      </form>

      <?php
      if (isset($_POST['simpan'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $harga = htmlspecialchars($_POST['harga']);
        $detail = htmlspecialchars($_POST['detail']);
        $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);


        $target_dir = "../image/";
        $nama_file = basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $nama_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_size = $_FILES['gambar']['size'];
        $random_name = generateRandomString(20);
        $new_name = $random_name . "." . $imageFileType;

        if ($nama == '' || $kategori == '' || $harga == '') {
          ?>
          <div class="alert alert-warning" role="alert">
            Nama,kategori dan harga wajid diisi
          </div>
          <?php
        } else {
          if ($nama_file != '') {
            if ($image_size > 700000) {
              ?>
              <div class="alert alert-warning" role="alert">
                File tidak boleh lebih dari 700 kb
              </div>
              <?php
            } else {
              if (
                $imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'
              ) {
                ?>
                <div class="alert alert-warning" role="alert">
                  File wajib bertipe jpg,jpeg atau png atau gif!
                </div>
                <?php
              } else {
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name);
              }
            }
          }
          // query insert to produk table
          $queryTambah = mysqli_query($con, "INSERT INTO produk  (kategori_id, nama, harga, foto,detail, stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

          if ($queryTambah) {
            ?>
            <div class="alert alert-primary" role="alert">
              Produk Berhasil Ditambahkan
            </div>
            <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
          } else {
            echo mysqli_error($con);
          }
        }
      }
      ?>
    </div>
    <div class="mt-3 mb-5">
      <h2>List Produk</h2>
      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Ketersediaan Stok</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($jumlahProduk == 0) {
              ?>
              <tr>
                <td colspan=6 class="text-center">Data Produk Tidak Tersedia</td>
              </tr>
              <?php
            } else {
              $jumlah = 1;
              while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                  <td>
                    <?php echo $jumlah; ?>
                  </td>
                  <td>
                    <?php echo $data['nama']; ?>
                  </td>
                  <td>
                    <?php echo $data['nama_kategori']; ?>
                  </td>
                  <td>
                    <?php echo $data['harga']; ?>
                  </td>
                  <td>
                    <?php echo $data['stok']; ?>
                  </td>
                  <td>
                    <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i
                        class="fas fa-search"></i></a>
                  </td>
                </tr>
                <?php
                $jumlah++;
              }

            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>