<?php
require_once 'config/cek_sesi.php';
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";
// panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
require_once "helper/fungsi_tanggal_indo.php";
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi CRUD Pegawai">
    <meta name="author" content="Rizqi Bagus">

    <!-- Title -->
    <title>Data Pegawai</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Custom CSS -->
    <style>
        #out-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            cursor: pointer;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            background-color: red;
            color: #ffffff;
            font-size: 24px;
            line-height: 50px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #out-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Header -->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top bg-primary shadow">
            <div class="container">
                <span class="navbar-brand text-white">
                    <img src="assets/img/icon1.png" style="opacity: 90%;" width="40" height="40">
                    Pangkalan Data Pegawai
                </span>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-shrink-0">
        <div class="container pt-5">
            <?php
            // pemanggilan file konten sesuai "halaman" yang dipilih
            // jika tidak ada halaman yang dipilih atau halaman yang dipilih "data"
            if (empty($_GET["halaman"]) || $_GET['halaman'] == 'data') {
                // panggil file tampil data
                include "tampil_data.php";
            }
            // jika halaman yang dipilih "entri"
            elseif ($_GET['halaman'] == 'entri') {
                // panggil file form entri
                include "form_entri.php";
            }
            // jika halaman yang dipilih "ubah"
            elseif ($_GET['halaman'] == 'ubah') {
                // panggil file form ubah
                include "form_ubah.php";
            }
            // jika halaman yang dipilih "detail"
            elseif ($_GET['halaman'] == 'detail') {
                // panggil file tampil detail
                include "tampil_detail.php";
            }
            // jika halaman yang dipilih "pencarian"
            elseif ($_GET['halaman'] == 'pencarian') {
                // panggil file tampil pencarian
                include "tampil_pencarian.php";
            }
            ?>
        </div>
    </main>

    <!-- Tombol Kembali ke Atas dan Keluar -->
    <button onclick="scrollLogout()" id="out-btn" title="Keluar"><</button>

    <!-- Footer -->
    <footer class="footer mt-auto bg-white shadow py-4">
        <div class="container">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                &copy; 2024 - <a href="#" target="_blank" class="text-brand text-decoration-none">Rizqi Bagus</a>. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/id.js" integrity="sha256-cvHCpHmt9EqKfsBeDHOujIlR5wZ8Wy3s90da1L3sGkc=" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/form-validation.js"></script>

    <!-- Script untuk fungsi tombol kembali ke atas dan keluar -->
    <script>
        // Fungsi untuk keluar
        function logout() {
            window.location.href = 'config/logout.php';
        }

        // Fungsi untuk kembali ke atas dan keluar
        function scrollLogout() {
            logout();
        }

        // Menampilkan tombol saat pengguna menggulir ke bawah
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("out-btn").style.display = "block";
            } else {
                document.getElementById("out-btn").style.display = "none";
            }
        }
    </script>
</body>

</html>
