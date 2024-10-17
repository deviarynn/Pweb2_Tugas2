<?php
//mendefinisikan class Database
class Database {
	//property privat untuk menyimpan informasi koneksi database
    private $host = "localhost"; //host untuk koneksi database
	private $username = "root";  //username untuk koneksi database
	private $password = "";		//password untuk koneksi database
	private $database = "persuratan_dosen"; //nama database yang akan digunakan
	protected $koneksi = "";	//property untuk menyimpan objek koneksi database bersifat protected

	//Constructor untuk menginisialisasi class yang dijalankan saat objek dibuat
    function __construct()
	{
		//menginisialisasi koneksi database menggunakan mysqli_connect
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		// Mengecek apakah koneksi gagal dan menampilkan pesan error jika gagal
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
	}
// Getter untuk mendapatkan koneksi
public function getConnection() {
    return $this->koneksi;
}
	//method tampilData di parent class Database
	function tampilData(){
	}
}
?>

