<?php
require_once 'config/cek_sesi.php';
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// mengecek data GET "id"
if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_pegawai = $mysqli->real_escape_string(trim($_GET['id']));

    // mengecek data foto profil
    // sql statement untuk menampilkan data "foto_profil" dari tabel "pegawai" berdasarkan "id_pegawai"
    $query = $mysqli->query("SELECT foto_profil FROM pegawai WHERE id_pegawai='$id_pegawai'")
                            or die('Ada kesalahan pada query tampil data : ' . $mysqli->error);
    // ambil data hasil query
    $data = $query->fetch_assoc();

    // hapus file foto dari folder images
    $hapus_file = unlink("images/$data[foto_profil]");

    // sql statement untuk delete data dari tabel "pegawai" berdasarkan "id_pegawai"
    $delete = $mysqli->query("DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'")
                            or die('Ada kesalahan pada query delete : ' . $mysqli->error);
    // cek query
    // jika proses delete berhasil
    if ($delete) {
        // Mengatur ulang ID agar urutannya benar
        $reset_id_query = "
            SET @count = 0;
            UPDATE pegawai SET id_pegawai = @count:= @count + 1;
            ALTER TABLE pegawai AUTO_INCREMENT = 1;
        ";
        $mysqli->multi_query($reset_id_query) or die('Ada kesalahan pada query reset ID : ' . $mysqli->error);

        // alihkan ke halaman data pegawai dan tampilkan pesan berhasil hapus data
        header('location: index.php?halaman=data&pesan=3');
    }
}
?>
