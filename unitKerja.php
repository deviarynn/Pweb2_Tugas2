<?php
// Class unitKerja yang mewarisi dari class Pengawas
class unitKerja extends Pengawas {
    public function __construct(){
        parent::__construct();
    }
    public function tampilData($unitkrj=null) {
        $query = "SELECT * FROM penggatian_pengawas_ujian where unit_kerja = '". $unitkrj ."'";
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