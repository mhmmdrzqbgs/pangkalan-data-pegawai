<div class="d-flex flex-column flex-lg-row mt-5 mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Pegawai</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?halaman=data" class="text-dark text-decoration-none">Pegawai</a></li>
                <li class="breadcrumb-item" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row flex-lg-row-reverse align-items-center mb-5">
<!-- button entri data -->
<div class="col-lg-4 col-xl-3">
    <a href="?halaman=entri" class="btn btn-primary rounded-pill float-lg-end py-2 px-4 mb-4 mb-lg-0">
        <i class="fa-solid fa-plus me-2"></i> Entri Pegawai
    </a>
</div>

    <!-- form pencarian -->
    <div class="col-lg-8 col-xl-9">
        <form action="?halaman=pencarian" method="post" class="form-search needs-validation" novalidate>
            <input type="text" name="kata_kunci" class="form-control rounded-pill" placeholder="Cari Pegawai ..." autocomplete="off" required>
            <div class="invalid-feedback">Masukkan ID atau Nama Pegawai yang ingin Anda cari.</div>
        </form>
    </div>
</div>

<?php
// menampilkan pesan sesuai dengan proses yang dijalankan
// jika pesan tersedia
if (isset($_GET['pesan'])) {
    // jika pesan = 1
    if ($_GET['pesan'] == 1) {
        // tampilkan pesan sukses simpan data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data pegawai berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // jika pesan = 2
    elseif ($_GET['pesan'] == 2) {
        // tampilkan pesan sukses ubah data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data pegawai berhasil diubah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    // jika pesan = 3
    elseif ($_GET['pesan'] == 3) {
        // tampilkan pesan sukses hapus data
        echo '<div class="alert alert-success alert-dismissible rounded-4 fade show mb-4" role="alert">
                <strong><i class="fa-solid fa-circle-check me-2"></i>Sukses!</strong> Data pegawai berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
}
?>

<div class="row mb-5">
    <?php
    /* 
        membatasi jumlah data yang ditampilkan dari database untuk membuat pagination/paginasi
    */
    // cek data "paginasi" pada URL untuk mengetahui paginasi halaman aktif
    // jika data "paginasi" ada, maka paginasi halaman = data "paginasi". jika data "paginasi" tidak ada, maka paginasi halaman = 1
    $paginasi_halaman = (isset($_GET['paginasi'])) ? (int) $_GET['paginasi'] : 1;
    // tentukan jumlah data yang ditampilkan per paginasi halaman
    $batas = 10;
    // tentukan dari data ke berapa yang akan ditampilkan pada paginasi halaman
    $batas_awal = ($paginasi_halaman - 1) * $batas;

    // sql statement untuk menampilkan data dari tabel "pegawai"
    $query = $mysqli->query("SELECT id_pegawai, divisi, nama_lengkap, foto_profil FROM pegawai
                            ORDER BY id_pegawai DESC LIMIT $batas_awal, $batas")
        or die('Ada kesalahan pada query tampil data : ' . $mysqli->error);
    // ambil jumlah data hasil query
    $rows = $query->num_rows;

    // cek hasil query
    // jika data pegawai ada
    if ($rows <> 0) {
        // ambil data hasil query
        while ($data = $query->fetch_assoc()) { ?>
            <!-- tampilkan data -->
            <div class="p-2">
                <div class="d-flex bg-white rounded-4 shadow-sm">
                    <div class="flex-shrink-0 p-3">
                        <img src="images/<?php echo $data['foto_profil']; ?>" class="border border-2 img-fluid rounded-4" alt="Foto Profil" width="100" height="100">
                    </div>
                    <div class="p-4 flex-grow-1">
                        <h5><?php echo $data['id_pegawai']; ?> - <?php echo $data['nama_lengkap']; ?></h5>
                        <p class="text-muted"><?php echo $data['divisi']; ?></p>
                    </div>
                    <div class="p-4">
                        <div class="d-flex flex-column flex-lg-row">
                            <!-- button form detail data -->
                            <a href="?halaman=detail&id=<?php echo $data['id_pegawai']; ?>" class="btn btn-primary btn-sm rounded-pill px-3 me-2 mb-2 mb-lg-0"> Detail </a>
                            <!-- button form ubah data -->
                            <a href="?halaman=ubah&id=<?php echo $data['id_pegawai']; ?>" class="btn btn-success btn-sm rounded-pill px-3 me-2 mb-2 mb-lg-0"> Ubah </a>
                            <!-- button modal hapus data -->
                            <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $data['id_pegawai']; ?>"> Hapus </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal hapus data -->
            <div class="modal fade" id="modalHapus<?php echo $data['id_pegawai']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                <i class="fa-regular fa-trash-can me-2"></i> Hapus Data Pegawai
                            </h1>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Anda yakin ingin menghapus data pegawai?</p>
                            <!-- informasi data yang akan dihapus -->
                            <p class="fw-bold mb-2"><?php echo $data['id_pegawai']; ?> <span class="fw-normal">-</span> <?php echo $data['nama_lengkap']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                            <!-- button proses hapus data -->
                            <a href="proses_hapus.php?id=<?php echo $data['id_pegawai']; ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="d-flex flex-column flex-xl-row align-items-center mt-4">
            <!-- menampilkan informasi jumlah paginasi halaman dan jumlah data -->
            <div class="flex-grow-1 text-center text-xl-start text-muted mb-3">
                <?php
                // sql statement untuk menampilkan jumlah data pada tabel "pegawai"
                $query = $mysqli->query("SELECT id_pegawai FROM pegawai")
                    or die('Ada kesalahan pada query jumlah data : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_data = $query->num_rows;

                // hitung jumlah paginasi halaman yang tersedia
                $jumlah_paginasi_halaman = ceil($jumlah_data / $batas);

                // cek jumlah data
                // jika data ada
                if ($jumlah_data <> 0) {
                    // tampilkan informasi jumlah paginasi halaman dan jumlah data
                    echo "Menampilkan " . ($batas_awal + 1) . " sampai " . ($batas_awal + $rows) . " dari " . $jumlah_data . " data";
                } else {
                    echo "Menampilkan 0 sampai 0 dari 0 data";
                }
                ?>
            </div>
            <!-- paginasi halaman -->
            <nav>
                <ul class="pagination pagination-sm justify-content-center justify-content-xl-end">
                    <?php
                    // cek jumlah paginasi halaman
                    // jika jumlah paginasi halaman <= 1, maka disable previous dan next page
                    if ($jumlah_paginasi_halaman <= 1) { ?>
                        <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angles-left"></i></span></li>
                        <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-left"></i></span></li>
                        <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-right"></i></span></li>
                        <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angles-right"></i></span></li>
                        <?php
                    } else {
                        // jika paginasi halaman aktif <= 3, maka set paginasi awal = 1 dan paginasi akhir = 5
                        if ($paginasi_halaman <= 3) {
                            $paginasi_awal = 1;
                            $paginasi_akhir = 5;
                        }
                        // jika paginasi halaman aktif di akhir2, maka set paginasi awal = paginasi halaman aktif - 3 dan paginasi akhir = jumlah paginasi halaman
                        elseif ($paginasi_halaman >= ($jumlah_paginasi_halaman - 2)) {
                            $paginasi_awal = $jumlah_paginasi_halaman - 4;
                            $paginasi_akhir = $jumlah_paginasi_halaman;
                        }
                        // selain itu, maka set paginasi awal = paginasi halaman aktif - 2 dan paginasi akhir = paginasi halaman aktif + 2
                        else {
                            $paginasi_awal = $paginasi_halaman - 2;
                            $paginasi_akhir = $paginasi_halaman + 2;
                        }

                        // previous page
                        // jika paginasi halaman aktif > 1, maka enabled previous page
                        if ($paginasi_halaman != 1) {
                            $previous = $paginasi_halaman - 1; ?>
                            <li class="page-item"><a class="page-link" href="?halaman=data&paginasi=1"><i class="fa-solid fa-angles-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="?halaman=data&paginasi=<?php echo $previous; ?>"><i class="fa-solid fa-angle-left"></i></a></li>
                        <?php
                        } else { ?>
                            <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angles-left"></i></span></li>
                            <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-left"></i></span></li>
                            <?php
                        }

                        // tampilkan angka paginasi halaman
                        for ($i = $paginasi_awal; $i <= $paginasi_akhir; $i++) {
                            if ($i == $paginasi_halaman) { ?>
                                <li class="page-item active"><span class="page-link"><?php echo $i; ?></span></li>
                            <?php
                            } else { ?>
                                <li class="page-item"><a class="page-link" href="?halaman=data&paginasi=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                        }

                        // next page
                        // jika paginasi halaman aktif < jumlah paginasi halaman, maka enabled next page
                        if ($paginasi_halaman != $jumlah_paginasi_halaman) {
                            $next = $paginasi_halaman + 1; ?>
                            <li class="page-item"><a class="page-link" href="?halaman=data&paginasi=<?php echo $next; ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                            <li class="page-item"><a class="page-link" href="?halaman=data&paginasi=<?php echo $jumlah_paginasi_halaman; ?>"><i class="fa-solid fa-angles-right"></i></a></li>
                        <?php
                        } else { ?>
                            <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angle-right"></i></span></li>
                            <li class="page-item disabled"><span class="page-link"><i class="fa-solid fa-angles-right"></i></span></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    <?php
    } else { ?>
        <div class="text-center">
            <!-- tampilkan pesan jika data tidak ada -->
            <img src="assets/img/empty.png" alt="Data Kosong" width="200" class="img-fluid">
            <h5 class="mt-3">Data tidak tersedia</h5>
        </div>
    <?php
    }
    ?>
</div>