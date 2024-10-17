<?php
require_once('Database.php');

// Class Pengawas yang mewarisi dari class Database
class Pengawas extends Database {
    function tampilData() {
        $query = "SELECT * FROM penggatian_pengawas_ujian";
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
$pengawas = new Pengawas();
$dataPengawas = $pengawas->tampilData();
 
?>