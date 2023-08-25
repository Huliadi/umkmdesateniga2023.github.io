<?php
session_start();
require '../connection.php';
?>s

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    .main {
      height: 100vh;
      background-color: #f8f9fa;
    }

    .login-box {
      width: 400px;
      max-width: 90%;
      padding: 30px;
      background-color: #ffffff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .login-box h2 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
      color: #343a40;
    }

    .login-box label {
      font-size: 16px;
      color: #343a40;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
      font-size: 16px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 15px;
    }

    .login-box button {
      font-size: 18px;
      background-color: #007bff;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-box button:hover {
      background-color: #0056b3;
    }

    .alert {
      font-size: 16px;
    }
  </style>
</head>

<body>
  <div class="main d-flex flex-column justify-content-center align-items-center">

    <div class="login-box shadow">
      <h2>Login</h2>
      <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>

        <button class="btn btn-primary form-control mt-3" type="submit" name="loginbtn">Login</button>
      </form>
    </div>
    <div class="mt-3">
      <?php
      if (isset($_POST['loginbtn'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $countdata = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        if ($countdata > 0) {
          if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;
            header('location:index.php');
          } else {
            echo '<div class="alert alert-warning" role="alert">Password Salah</div>';
          }
        } else {
          echo '<div class="alert alert-warning" role="alert">Akun Tidak Tersedia</div>';
        }
      }
      ?>
    </div>
  </div>
</body>

</html>