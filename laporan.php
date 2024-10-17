<?php
require_once('Database.php');

// Class laporanLembur yang juga mewarisi dari Database
class LaporanLembur extends Database {
    function tampilData() {
        $query = "SELECT * FROM laporan_kerja_lembur";
        $data = mysqli_query($this->koneksi, $query);

        $hasil = [];
        if ($data && mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_array($data)) {
                $hasil[] = $row;
            }
        }
        return $hasil;
    }
}
// Membuat instansiasi objek dari class LaporanLembur
$laporan = new LaporanLembur();
$dataLaporan = $laporan->tampilData();
?>