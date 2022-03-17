<?php

include_once "function.php";

if (isset($_SESSION['login'])) {
  echo "<script>alert('anda sudah login');</script>";
  if ($_SESSION['role'] == 1) {
    // echo "<script>alert('anda sudah login')</script>";
    echo "<script>location='dashboard_admin.php'</script>";
  } else if ($_SESSION['role'] == 2) {
    echo "<script>location='halguru.php'</script>";
  } else if ($_SESSION['role'] == 3) {
    echo "<script>location='indexsiswa.php'</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css"> -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="login/template/assets/css/login.css">
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">

          <div class="col-md-7">
            <div class="card-body">

              <p class="login-card-description">Login</p>
              <form action="function.php?proses_login" method="POST">
                <div class="form-group">
                  <label for="username" class="sr-only">username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="username">
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                </div>
                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
              </form>
              <a href="#!" class="forgot-password-link">Lupa Password?</a>
              <p class="login-card-footer-text">Belum punya akun? | <a href="registrasi2.php" class="text-reset" target="_blank">Daftar disini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>