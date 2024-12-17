<?php
session_start();
if (isset($_SESSION['nama_pengguna'])) {
  header("location: index.php");
  exit();
}

include('config/database.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_pengguna = $_POST['nama_pengguna'];
  $kata_sandi = $_POST['kata_sandi'];

  $nama_pengguna = stripslashes($nama_pengguna);
  $kata_sandi = stripslashes($kata_sandi);
  $nama_pengguna = mysqli_real_escape_string($mysqli, $nama_pengguna);
  $kata_sandi = mysqli_real_escape_string($mysqli, $kata_sandi);

  $sql = "SELECT * FROM users WHERE nama_pengguna = '$nama_pengguna'";
  $result = mysqli_query($mysqli, $sql);
  $row = mysqli_fetch_assoc($result);

  if (mysqli_num_rows($result) == 1 && password_verify($kata_sandi, $row['kata_sandi'])) {
    $_SESSION['nama_pengguna'] = $nama_pengguna;
    header("location: index.php");
    exit(); // Pastikan untuk keluar setelah mengarahkan pengguna
  } else {
    $error = "Nama pengguna atau kata sandi salah.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Data Pegawai</title>
  <link rel="shortcut icon" type="image/png" href="assets/img/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
  <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
          <div class="card mb-0">
            <div class="card-body">
              <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="assets/img/icon1.png" width="100" alt="">
              </a>
              <p class="text-center">Pangkalan Data Pegawai</p>
              <?php if ($error != '') : ?>
                <div class="alert alert-danger" role="alert">
                  <?php echo $error; ?>
                </div>
              <?php endif; ?>
              <form action="login.php" method="post">
                <div class="mb-3">
                  <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                  <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
                </div>
                <div class="mb-4">
                  <label for="kata_sandi" class="form-label">Kata Sandi</label>
                  <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                  <div class="form-check">
                    <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                      Ingat Perangkat Ini
                    </label>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-4 rounded-2">Masuk</button>
                <div class="d-flex align-items-center justify-content-center">
                  <p class=" mb-0">Belum Mempunyai Akun?</p>
                  <a class="text-primary ms-2" href="register.php">Buat akun</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>