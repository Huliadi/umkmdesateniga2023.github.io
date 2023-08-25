<?php
require "session.php";
require "../connection.php";

$id = $_GET['p'];

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Kategori</title>

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }

    .alert {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <?php
  require "navbar.php"
    ?>
  <div class="container mt-5">
    <h2>Detail Kategori</h2>

    <div class="col-12 card col-md-6">
      <form action="" method="post">
        <div class="">
          <label for="kategori">
            Kategori
            <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama']; ?>">
          </label>
        </div>

        <div class="mt-5 ">
          <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
          <button type="submit" class="btn btn-danger" name="deleteBtn">Hapus</button>


        </div>
      </form>
      <?php
      if (isset($_POST['editBtn'])) {
        $kategori = htmlspecialchars($_POST['kategori']);

        if ($data['nama'] == $kategori) {
          ?>
          <meta http-equiv="refresh" content="0; url=kategori.php" />
          <?php
        } else {
          $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
          $jumlahData = mysqli_num_rows($query);

          if ($jumlahData > 0) {
            ?>
            <div class="alert alert-warning" role="alert">
              Kategori Sudah Ada!
            </div>
            <?php
          } else {
            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
            if ($querySimpan) {
              ?>
              <div class="alert alert-success" role="alert">
                Kategori Berhasil Diedit
              </div>
              <meta http-equiv="refresh" content="1; url=kategori.php" />
              <?php
            } else {
              echo mysqli_error($con);
            }
          }
        }
      }
      if (isset($_POST['deleteBtn'])) {
        $querycheck = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$id'");
        $dataCount = mysqli_num_rows($querycheck);

        if ($dataCount > 0) {
          ?>
          <div class="alert alert-warning" role="alert">
            Kategori tidak bisa di hapus karena sudah digunakan di produk
          </div>
          <?php
          die();
        }

        $queryDelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

        if ($queryDelete) {
          ?>
          <div class="alert alert-success" role="alert">
            Kategori Berhasil Dihapus
          </div>
          <meta http-equiv="refresh" content="1; url=kategori.php" />
          <?php
        } else {
          echo mysqli_error($con);
        }
      }
      ?>
    </div>
  </div>

  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>