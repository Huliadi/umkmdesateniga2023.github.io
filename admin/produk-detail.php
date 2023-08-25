<?php
require "session.php";
require "../connection.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT a. *, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");


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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Detail</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

</head>
<style>
  form div {
    margin-bottom: 10px;
  }
</style>

<body>
  <?php
  require "navbar.php";
  ?>

  <div class="container mt-5 mb-5">
    <h2>Detail Produk</h2>

    <div class="col-12 col-md-6">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="">
          <label for="nama">
            Nama
            <input type="text" name="nama" value="<?php echo $data['nama'] ?>" id="nama" class="form-control"
              autocomplete="off" required>
          </label>
        </div>
        <div class="">
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control" required>
            <option value="<?php echo $data['kategori_id'] ?>"><?php echo $data['nama_kategori'] ?></option>
            <?php
            while ($dataKategori = mysqli_fetch_array($queryKategori)) {
              ?>
              <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama']; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="">
          <label for="harga">
            Harga
            <input type="number" value="<?php echo $data['harga']; ?>" name="harga" class="form-control" required>
          </label>
        </div>
        <div class="">
          <label for="curentGambar">Gambar Produk Sekarang</label>
          <img src="../image/<?php echo $data['foto']; ?>" alt="" width="250px">
        </div>
        <div class="">
          <label for="gambar">
            Gambar
            <input type="file" name="gambar" class="form-control" id="gambar">
          </label>
        </div>
        <div class="">
          <label for="detail"> Detail
            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
            <?php echo $data['detail']; ?>
           </textarea>
          </label>
        </div>
        <div class="">
          <label for="ketersediaan_stok">
            Kategori Stok
            <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
              <option value="<?php echo $data['stok']; ?>"><?php echo $data['stok']; ?></option>
              <?php
              if ($data['stok'] == 'tersedia') {
                ?>
                <option value="habis">habis</option>
                <?php
              } else {
                ?>
                <option value="tersedia">tersedia</option>
                <?php
              }
              ?>
            </select>
          </label>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
          <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
        </div>
      </form>

      <?php
      if (isset($_POST['simpan'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $harga = floatval($_POST['harga']);
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
          $query = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga',  detail='$detail', stok='$ketersediaan_stok' WHERE id=$id");

          if ($nama_file != '') {
            if ($image_size > 700000) {
              ?>
              <div class="alert alert-warning" role="alert">
                File tidak boleh lebih dari 700 kb!
              </div>
              <?php
            } else {
              if (
                $imageFileType != 'jpg' &&
                $imageFileType != 'jpeg' &&
                $imageFileType != 'png' &&
                $imageFileType != 'gif'
              ) {
                ?>
                <div class="alert alert-warning" role="alert">
                  File wajib bertipe jpg atau png atau gif!
                </div>
                <?php
              } else {
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $new_name);

                $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                if ($queryUpdate) {
                  ?>
                  <div class="alert alert-primary" role="alert">
                    Produk Berhasil Diupdate
                  </div>
                  <meta http-equiv="refresh" content="2; url=produk.php" />
                  <?php
                } else {
                  echo mysqli_error($con);
                }
              }
            }

          }
        }
      }

      if (isset($_POST['hapus'])) {
        $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");

        if ($queryHapus) {
          ?>
          <div class="alert alert-success" role="alert">
            Produk Berhasil Dihapus
          </div>
          <meta http-equiv="refresh" content="2; url=produk.php" />
          <?php
        }
      }
      ?>
    </div>
  </div>


  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>