<?php
// Class Dosen yang juga mewarisi dari LaporanLembur
class Dosen extends LaporanLembur {
    public function __construct(){
        parent::__construct();
    }
    public function tampilData($dosen=null) {
        $query = "SELECT * FROM laporan_kerja_lembur where nama_dosen = '". $dosen ."'";
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
?>
