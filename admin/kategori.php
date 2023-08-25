<?php
require "session.php";
require '../connection.php';


$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

  <style>
    .no-decoration {
      text-decoration: none;
    }

    body {
      background-color: #f8f9fa;
    }

    .breadcrumb-item.active {
      color: #007bff;
    }

    .breadcrumb-item.active:hover {
      color: #0056b3;
    }

    .breadcrumb-item.active i {
      color: #007bff;
    }

    .my-5 {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table th {
      background-color: #f8f9fa;
      border: none;
    }

    .table td {
      vertical-align: middle;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .btn-info {
      background-color: #17a2b8;
      border-color: #17a2b8;
    }

    .btn-info:hover {
      background-color: #117a8b;
      border-color: #117a8b;
    }

    .alert {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"> <a href="../admin" class="no-decoration text-muted"><i
              class="fas fa-home"></i> Home </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-justify"></i> Kategori</li>
      </ol>
    </nav>

    <div class="my-5 col-12 col-md-6">
      <h3>Tambah Kategori</h3>

      <form action="" method="post">
        <div class="">
          <label for="kategori">
            Kategori
            <input type="text" name="kategori" id="kategori" placeholder="Input nama kategori" class="form-control">
          </label>
        </div>
        <div class="mt-3">
          <button class=" btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
        </div>
      </form>

      <?php
      if (isset($_POST['simpan_kategori'])) {
        $kategori = htmlspecialchars($_POST['kategori']);

        $queriExis = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
        $jumlahKategoriBaru = mysqli_num_rows($queriExis);

        if ($jumlahKategoriBaru > 0) {
          ?>
          <div class="alert alert-warning mt-3" role="alert">
            Kategori Sudah Ada!
          </div>
          <?php
        } else {
          $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");

          if ($querySimpan) {
            ?>
            <div class="alert alert-primary" role="alert">
              Kategori Berhasil Ditambahkan
            </div>
            <meta http-equiv="refresh" content="1; url=kategori.php" />
            <?php

          } else {
            echo mysqli_error($con);
          }
        }
      }
      ?>
    </div>


    <div class="mt-3">
      <h2>List Kategori</h2>

      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($jumlahKategori == 0) {
              ?>
              <tr>
                <td colspan="3" class="text-center">Data kategori tidak tersedia</td>
              </tr>
              <?php
            } else {
              $jumlah = 1;
              while ($data = mysqli_fetch_array($queryKategori)) {
                ?>
                <tr>
                  <td>
                    <?php echo $jumlah; ?>
                  </td>
                  <td>
                    <?php echo $data['nama']; ?>
                  </td>
                  <td>
                    <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i
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