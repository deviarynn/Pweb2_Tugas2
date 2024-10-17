# TUGAS 2 (PHP OOP Case Study)
## Task:
1. Membuat tampilan berbasis OOP dengan mengambil data dari database MySQL.
2. Menggunakan metode _construct untuk koneksi database.
3. Menerapkan enkapsulasi sesuai logika studi kasus.
4. Membuat kelas turunan menggunakan konsep pewarisan (inheritance).
5. Menerapkan polimorfisme untuk minimal dua peran sesuai studi kasus.

#### Case Study: Menggunakan tabel laporan_kerja_lembur dan penggantian_pengawas_ujian</p>

### 1. Membuat Database dan tabel laporan_kerja_lembur dan penggantian_pengawas_ujian

#### Membuat database dan tabel laporan_kerja_lembur dan penggantian_pengawas_ujian di phpmyadmin. Nama dan isi tabel disesuaikan dengan ERD yang dibuat.<br>
Isi tabel Penggantian Pengawas Ujian meliputi:
```php
    <ol>
        <th scope="col">ID</th>
            <th scope="col">Nama Pengawas Diganti</th>
            <th scope="col">Unit Kerja</th>
            <th scope="col">Hari/Tanggal Penggantian</th>
            <th scope="col">Jam Penggantian</th>
            <th scope="col">Ruang</th>
            <th scope="col">Nama Pengawas Pengganti</th>
            <th scope="col">Nama Dosen</th>
    </ol>
```

```php
Isi tabel laporan_kerja_lembur meliputi:
    <ol>
        <th scope="col">ID</th>
        <th scope="col">Tanggal Laporan</th>
        <th scope="col">Waktu</th>
        <th scope="col">Uraian Pekerjaan</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Nama Dosen</th>
    </ol>
```

### 2. Gunakan fungsi __Construct untuk mengkoneksi ke database

```php
    //Constructor untuk menginisialisasi class yang dijalankan saat objek dibuat
    function __construct(){
      	//menginisialisasi koneksi database menggunakan mysqli_connect
      	$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
    }
```
- Construktor akan dipanggil saat objek dari kelas Database dibuat.
- mysqli_connect($this->host, $this->username, $this->password, $this->database) untuk membuat koneksi ke database menggunakan informasi yang telah dideklarasikan.
- if (mysqli_connect_errno()){ ... } digunakan untuk memeriksa apakah koneksi gagal dan jika ya akan menampilkan pesan kesalahan dengan mysqli_connect_error().

```php
    //method tampilData di parent class Database
    function tampilData(){
    }
```
Metode tampilData di parent class Database yang akan di implemetasikan di class turunannya
           

#### Berikut Full Kodenya:

```php
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

            //method tampilData di parent class Database
          	function tampilData(){
          	}
          }
          ?>
```

### 3. Terapkan enskapsulasi

```php
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
```
- class Database mendefinisikan class dengan nama Database sebagai parent class.
- private $host = "localhost", private $username = "root", private $password = "", private $database = "persuratan_dosen"	digunakan untuk mendeklarasikan property privat tersebut yang menyimpan data untuk koneksi database. Property yang digunakan bersifat private yang artinya hanya dapat diakses dari dalam class Databse itu sendiri. Metode ini merupakan Encaplutaion dimana menyembunyikan data internal dari akses langsung luar class

- protected $koneksi = "" digunakan untuk mendeklarasikan property dilindungi $koneksi yang akan menyimpan objek koneksi database. Property yang digunakan bersifat protected artinya property ini dapat diakses oleh class Database dan class yang mewarisi (child class) tetapi tidak dapat diakses dari luar kelas.

### 4. Mambuat Class turunan menggunakan konsep pewarisan
#### Membuat Class Pengawas yang mewarisi Class Database
a. Definisi class Pengawas

```php
    <?php
    require_once('Database.php');

    // Class Pengawas yang mewarisi dari class Database
    class Pengawas extends Database {
```
- require_once ('Database.php') untuk menyertakan file Database.php yang berisi definisi class Database ke dalam skrip ini. Ini memastikan file hanya disertakan satu kali.</p>
- Class Pengawas (child class) mewarisi (inheritance) dari class Database (parent class). Ini berarti Repotrs memiliki akses ke semua properti dan metode yang didefinisikan dalam Database termasuk koneksi ke database.</p>
        
```php
    /* Override method tampilData
    method untuk mengambil dan menampilkan data dari tabel penggantian_pengawas_ujian*/
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
```
<p>Metode tampilData dalam kelas Pengawas digunakan untuk mengambil data dari tabel penggantian_pengawas_ujian.. Metode ini mengembalikan data dalam bentuk array.</p>
    
```php
     //membuat instansiasi objek dari class Pengawas
        $pengawas = new Pengawas();
```
<p>Membuat objek baru dari kelas Pengawas yang secara otomatis akan memanggil Construktor dari kelas Database untuk menginisialisasi koneksi database.</p>

```php
    // Memanggil fungsi "tampilData" dan menyimpan hasilnya ke variabel $data.
        $dataPengawas = $pengawas->tampilData();
```
b. Full Kodenya:

```php
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
```
Kelas **Pengawas** adalah subclass dari kelas **Database**, yang artinya kelas ini mewarisi semua atribut dan metode dari kelas **Database**. Dengan mekanisme pewarisan ini, **Pengawas** dapat menggunakan koneksi database yang sudah ada di kelas **Database** tanpa perlu mendefinisikannya kembali. Hal ini membantu mengatur kode dengan lebih efisien, karena fungsi yang bersifat umum ditempatkan di kelas induk, sedangkan hal-hal yang lebih spesifik ditangani oleh kelas turunannya.

#### Membuat Class LaporanLembur yang mewarisi Class Database
a. Definisi Class LaporanLembur

```php
    require_once ('Database.php');
    //class LaporanLembur yang mewarisi dari class Database
    class LaporanLembur extends Database {
```
- Require_once ('Database.php') untuk menyertakan file Database.php yang berisi definisi class Database ke dalam skrip ini. Ini memastikan file hanya disertakan satu kali.
- Class LaporanLembur (child class) mewarisi (inheritance) dari class Database (parent class). Ini berarti LaporanLembur memiliki akses ke semua properti dan metode yang didefinisikan dalam Database termasuk koneksi ke database.

```php
          
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
```
<p>Metode tampilData di-override dalam kelas LaporanLembur untuk mengambil data spesifik dari tabel laporan_kerja_lembur. Metode ini mengembalikan data yang diambil dalam bentuk array $hasil.</p>

```php
    // Membuat instansiasi objek dari class LaporanLembur
    $laporan = new LaporanLembur();
```
<p>Membuat objek LaporanLembur yang secara otomatis menginisialisasi koneksi database.</p>

```php
    // Memanggil fungsi "tampilData" dan menyimpan hasilnya ke variabel $dataLaporan.
    $dataLaporan = $laporan->tampilData();
```
b. Full Kodenya:

```php
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
```
Script ini memuat file database.php yang berisi class Database dengan koneksi ke database. KClaselas LaporanLembur didefinisikan sebagai subclass dari Database dan mewarisi semua properti dan metode yang ada, termasuk koneksi ke database. Dalam kelas LaporanLembur, terdapat metode tampilData() yang berfungsi untuk mengambil data dari tabel laporan_kerja_lembur menggunakan perintah SQL. Hasil query disimpan dalam variabel, diolah menjadi array asosiatif, dan dikembalikan sebagai output. Di akhir script, sebuah objek dari kelas LaporanLembur dibuat, lalu metode tampilData() dipanggil untuk mengambil data dari tabel tersebut.


<b>Selanjutnya, class Pengawas dan LaporanLembur juga mewariskan sifat ke sub class masing-masing, yaitu class unitKerja sebagai child class dari Pengawas(parent class), dan class Dosen sebagai child class dari LaporanLembur.</b>

#### 1. Membuat Class unitKerja yang mewarisi Class Pengawas
Definisi class unitKerja

```php
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
```

#### Script diatas merupakan class turunan dari Pengawas yang masih general. Berikut dibawah ini adalah class turunan Pengawas yang lebih spesifik.

<b>a. Class unitKerja kategori Bidang Kemahasiswaan</b> 

```php
<?php
    require_once('pengawas.php');
    require_once('unitKerja.php');

    // Membuat instansiasi objek dari class unitKerja
    $unitkrj = new unitKerja();
    $dataUnit = $unitkrj->tampilData('Bidang Kemahasiswaan');
?>
```
- `require_once('pengawas.php');` : Mengimpor (memanggil) file 'pengawas.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('unitKerja.php');` : Mengimpor (memanggil) file 'unitKerja.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$unitkrj = new unitKerja();`
Membuat objek baru dari kelas unitKerja yang secara otomatis akan memanggil Construktor dari kelas unitKerja untuk menginisialisasi koneksi database.
- `$dataUnit = $unitkrj->tampilData('Bidang Kemahasiswaan');`
Data ini akan disimpan dalam variabel $dataUnit dan digunakan untuk menampilkan data Unit Kerja hanya Bidang Kemahasiswaan.

Disini tidak perlu ditulis ulang lagi pendeklarasian class unitKerja nya karena terdapat code `require_once ('unitKerja.php');` yang otomatis memanggil deklarasi class unitKerja secara lengkap yang terdapat di file `unitKerja.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.


<b>b. Class unitKerja kategori Bidang SAINS Akademik</b> 

```php
<?php
    require_once('pengawas.php');
    require_once('unitKerja.php');

    // Membuat instansiasi objek dari class unitKerja
    $unitkrj = new unitKerja();
    $dataUnit = $unitkrj->tampilData('Bidang SAINS Akademik');
?>
```
- `require_once('pengawas.php');` : Mengimpor (memanggil) file 'pengawas.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('unitKerja.php');` : Mengimpor (memanggil) file 'unitKerja.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$unitkrj = new unitKerja();`
Membuat objek baru dari kelas unitKerja yang secara otomatis akan memanggil Construktor dari kelas unitKerja untuk menginisialisasi koneksi database.
- `$dataUnit = $unitkrj->tampilData('Bidang SAINS Akademik');`
Data ini akan disimpan dalam variabel $dataUnit dan digunakan untuk menampilkan data Unit Kerja hanya Bidang SAINS Akademik.

Disini tidak perlu ditulis ulang lagi pendeklarasian class unitKerja nya karena terdapat code `require_once ('unitKerja.php');` yang otomatis memanggil deklarasi class unitKerja secara lengkap yang terdapat di file `unitKerja.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.

<b>c. Class unitKerja kategori Bidang Mechine Learning</b> 

```php
<?php
    require_once('pengawas.php');
    require_once('unitKerja.php');

    // Membuat instansiasi objek dari class unitKerja
    $unitkrj = new unitKerja();
    $dataUnit = $unitkrj->tampilData('Bidang Mechine Learning');
?>
```
- `require_once('pengawas.php');` : Mengimpor (memanggil) file 'pengawas.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('unitKerja.php');` : Mengimpor (memanggil) file 'unitKerja.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$unitkrj = new unitKerja();`
Membuat objek baru dari kelas unitKerja yang secara otomatis akan memanggil Construktor dari kelas unitKerja untuk menginisialisasi koneksi database.
- `$dataUnit = $unitkrj->tampilData('Bidang Mechine Learning');`
Data ini akan disimpan dalam variabel $dataUnit dan digunakan untuk menampilkan data Unit Kerja hanya Bidang Mechine Learning.

Disini tidak perlu ditulis ulang lagi pendeklarasian class unitKerja nya karena terdapat code `require_once ('unitKerja.php');` yang otomatis memanggil deklarasi class unitKerja secara lengkap yang terdapat di file `unitKerja.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.


#### 2. Membuat Class Dosen yang mewarisi Class LaporanLembur
Definisi class Dosen

```php
<?php
// Class Dosen yang mewarisi dari class Dosen
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
```

#### Script diatas merupakan class turunan dari Dosen yang masih general. Berikut dibawah ini adalah class turunan Pengawas yang lebih spesifik.

<b>a. Class Dosen kategori Nama Dosen Devi Aryanii</b> 

```php

<?php>
    require_once('laporan.php');
    require_once('dosen.php');

    // Membuat instansiasi objek dari class Dosen
    $dosen = new Dosen();
    $dataDosen = $dosen->tampilData('Devi Aryanii');
?>
```
- `require_once('laporan.php');` : Mengimpor (memanggil) file 'laporan.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('dosen.php');` : Mengimpor (memanggil) file 'dosen.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$dosen = new Dosen();`
Membuat objek baru dari kelas Dosen yang secara otomatis akan memanggil Construktor dari kelas Dosen untuk menginisialisasi koneksi database.
- `$dataDosen = $dosen->tampilData('Devi Aryanii');`
Data ini akan disimpan dalam variabel $dataDosen dan digunakan untuk menampilkan data Dosen dengan nama = `Devi Aryanii`.

Disini tidak perlu ditulis ulang lagi pendeklarasian class Dosen nya karena terdapat code `require_once ('dosen.php');` yang otomatis memanggil deklarasi class Dosen dengan lengkap yang terdapat di file `dosen.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.


<b>b. Class Dosen kategori Nama Dosen Chiko Jerome</b>

```php
<?php>
    require_once('laporan.php');
    require_once('dosen.php');

    // Membuat instansiasi objek dari class Dosen
    $dosen = new Dosen();
    $dataDosen = $dosen->tampilData('Chiko Jerome');
?>
```
- `require_once('laporan.php');` : Mengimpor (memanggil) file 'laporan.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('dosen.php');` : Mengimpor (memanggil) file 'dosen.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$dosen = new Dosen();`
Membuat objek baru dari kelas Dosen yang secara otomatis akan memanggil Construktor dari kelas Dosen untuk menginisialisasi koneksi database.
- `$dataDosen = $dosen->tampilData('Chiko Jerome');`
Data ini akan disimpan dalam variabel $dataDosen dan digunakan untuk menampilkan data Dosen dengan nama = `Chiko Jerome`.

Disini tidak perlu ditulis ulang lagi pendeklarasian class Dosen nya karena terdapat code `require_once ('dosen.php');` yang otomatis memanggil deklarasi class Dosen dengan lengkap yang terdapat di file `dosen.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.

<b>c. Class Dosen kategori Nama Dosen Vannya S.Pd., M.Pd., Kom</b>

```php
<?php>
    require_once('laporan.php');
    require_once('dosen.php');

    // Membuat instansiasi objek dari class Dosen
    $dosen = new Dosen();
    $dataDosen = $dosen->tampilData('Vannya S.Pd., M.Pd., Kom');
?>
```
- `require_once('laporan.php');` : Mengimpor (memanggil) file 'laporan.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
- `require_once('dosen.php');` : Mengimpor (memanggil) file 'dosen.php' hanya sekali untuk memastikan kelas atau fungsi di dalamnya dapat digunakan di sini.
-`$dosen = new Dosen();`
Membuat objek baru dari kelas Dosen yang secara otomatis akan memanggil Construktor dari kelas Dosen untuk menginisialisasi koneksi database.
- `$dataDosen = $dosen->tampilData('Vannya S.Pd., M.Pd., Kom');`
Data ini akan disimpan dalam variabel $dataDosen dan digunakan untuk menampilkan data Dosen dengan nama = `Vannya S.Pd., M.Pd., Kom`.

Disini tidak perlu ditulis ulang lagi pendeklarasian class Dosen nya karena terdapat code `require_once ('dosen.php');` yang otomatis memanggil deklarasi class Dosen dengan lengkap yang terdapat di file `dosen.php`. Langsung dilanjut saja dengan script bootstrap html agar dapat menampilkan tabel.

### 5. Terapkan polimorfisme untuk minimal 2 peran sesuai studi kasus

- Class Database->Class Pengawas->Class unitKerja (kategori Bidang Kemahasiswaan, Bidang SAINS Akademik, Bidang Mechine Learning)
```php
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
 
 -----------------------------------------

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

//class unitKerja kategori Bidang Kemahasiswaan
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang Kemahasiswaan');

//class unitKerja kategori Bidang SAINS Akademik
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang SAINS Akademik');

//class unitKerja kategori Bidang Mechine Learning
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang Mechine Learning');

```
Untuk Class per Bidang Unit Kerja, tinggal menambahkan `$unitkrj = new unitKerja();`
`$dataUnit = $unitkrj->tampilData('Bidang Kemahasiswaan');` (sesuaikan dengan bidang masing-masing). Letakan kode tsb di file perkategori digabung dengan kode html-nya.
-----------------------------------------------------
- Class Database->Class LaporanLembur->Class Dosen (kategori nama dosen Devi Aryanii, Chiko Jerome, dan Vannya S.Pd., M.Pd., Kom)

```php
<?php
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

//Class Dosen kategori nama dosen Devi Aryanii
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Devi Aryanii');

//Class Dosen kategori nama dosen Chiko Jerome
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Chiko Jerome');

//Class Dosen kategori nama dosen Vannya S.Pd., M.Pd., Kom
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Vannya S.Pd., M.Pd., Kom');

?>
```
Untuk Class per nama Dosen, tinggal menambahkan `$$dosen = new Dosen();`
`$dataDosen = $dosen->tampilData('Devi Aryanii');` (sesuaikan dengan bidang masing-masing). Letakan kode tsb di file perkategori digabung dengan kode html-nya.

Polimorfisme ditunjukkan melalui metode tampilData() yang ada di class Pengawas, LaporanLembur, unitKerja, dan Dosen. 

- class unitKerja mewarisi dari class Pengawas, sehingga bisa menggunakan semua metode dari class induknya. Namun, class unitKerja menimpa (override) metode tampilData() untuk menampilkan data khusus yang hanya berisi keterangan `unit_kerja` per bidang, seperti Bidang Kemahasiswaan, Bidang SAINS Akademik, dan Bidang Mechine Learning. 
- Sama seperti class Dosen, yang juga mewarisi dari class LaporanLembur dan menimpa metode tampilData() untuk mengambil data dengan keterangan `nama_dosen` kategori nama Devi Aryanii, Chiko Jerome, dan Vannya S.Pd., M.Pd., Kom. Jadi, meskipun ketiga class memiliki metode dengan nama yang sama, setiap class mengimplementasikan cara yang berbeda. 

Ketika metode tampilData() dipanggil dari objek class unitKerja, hasil yang ditampilkan adalah data dengan keterangan `unit_kerja` per bidang, seperti Bidang Kemahasiswaan, Bidang SAINS Akademik, dan Bidang Mechine Learning. Sementara itu, jika dipanggil dari objek class Dosen, akan menampilkan data dengan keterangan `nama_dosen` kategori nama Devi Aryanii, Chiko Jerome, dan Vannya S.Pd., M.Pd., Kom.

### 6. Dashboard menampilkan semua data tabel Penggantian Pengawas Ujian dan Laporan Kerja Lembur (Bootstrap dengan Navbar)

```php
    <?php
    require_once('Database.php');
    require_once('pengawas.php');
    require_once('laporan.php');
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tampil Semua Data</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 16px;
            }
            th, td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ddd;
            }
            .thead-blue {
                background-color: #006666;
                text-align: center;
                color: white;
            }
            tbody tr:hover {
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body class="bg-gray-100 p-10">

    <!-- Navbar menggunakan Bootstrap 5 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <!-- Menu untuk Semua Data -->
                <li class="nav-item">
                    <a class="nav-link active" href="tampilAll.php">Semua Data</a>
                </li>

                <!-- Dropdown untuk Data Unit Kerja -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data Unit Kerja
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                        <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                        <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                    </ul>
                </li>

                <!-- Dropdown untuk Tanggal Laporan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dosen       
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                        <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                        <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    <div class="container mt-4">
        <!-- Membuat sebuah container dengan margin atas 4 (mt-4) untuk memberikan jarak antara elemen di atas dan container ini -->
        
        <h4 style="text-align: center;">Data Penggantian Pengawas Ujian</h4>
        <!-- Menampilkan judul untuk bagian "Data Penggantian Pengawas Ujian", dengan teks yang dirata-tengah (text-align: center) -->
        
        <table class="table" border="1px">
        <!-- Membuat tabel dengan kelas Bootstrap "table" dan menambahkan border sebesar 1px pada tabel -->
        
    <thead class="thead-blue">
        <!-- Bagian header tabel -->
        <tr>
            <!-- Membuat baris pada bagian header tabel -->
                    <th scope="col">ID</th>
                    <!-- Kolom untuk menampilkan ID penggantian pengawas -->
                    <th scope="col">Nama Pengawas Diganti</th>
                    <!-- Kolom untuk menampilkan nama pengawas yang diganti -->
                    <th scope="col">Unit Kerja</th>
                    <!-- Kolom untuk menampilkan unit kerja dari pengawas yang diganti -->
                    <th scope="col">Hari/Tanggal Penggantian</th>
                    <!-- Kolom untuk menampilkan hari dan tanggal penggantian pengawas -->
                    <th scope="col">Jam Penggantian</th>
                    <!-- Kolom untuk menampilkan jam penggantian pengawas -->
                    <th scope="col">Ruang</th>
                    <!-- Kolom untuk menampilkan ruang di mana pengawas digantikan -->
                    <th scope="col">Nama Pengawas Pengganti</th>
                    <!-- Kolom untuk menampilkan nama pengawas pengganti -->
                    <th scope="col">Nama Dosen</th>
                    <!-- Kolom untuk menampilkan nama dosen yang terkait dengan pengawasan ujian -->
                </tr>
        </thead>
            
        <tbody>
            <?php
            if (!empty($dataPengawas)) {
            // Memeriksa apakah variabel $dataPengawas tidak kosong
            $no = 1;
            // Inisialisasi variabel $no dengan nilai 1, meskipun tidak digunakan dalam kode yang diberikan
                    
            foreach ($dataPengawas as $x) {
            // Melakukan loop pada setiap item dalam array $dataPengawas
                    
                echo "<tr>
                    <td>{$x['id_pengganti']}</td>
                    <!-- Menampilkan ID pengganti dari data pengawas -->
                    <td>{$x['nama_pengawas_diganti']}</td>
                    <!-- Menampilkan nama pengawas yang diganti dari data pengawas -->
                    <td>{$x['unit_kerja']}</td>
                    <!-- Menampilkan unit kerja dari pengawas yang diganti -->
                    <td>{$x['hari_tgl_penggantian']}</td>
                    <!-- Menampilkan hari dan tanggal penggantian pengawas -->
                    <td>{$x['jam']}</td>
                    <!-- Menampilkan jam penggantian pengawas -->
                    <td>{$x['ruang']}</td>
                    <!-- Menampilkan ruang di mana pengawasan dilakukan -->
                    <td>{$x['nama_pengawas_pengganti']}</td>
                    <!-- Menampilkan nama pengawas pengganti -->
                    <td>{$x['nama_dosen']}</td>
                    <!-- Menampilkan nama dosen yang terkait dengan pengawasan ujian -->
                    </tr>";
                    }
                } else {
                    // Jika tidak ada data pengawas yang tersedia (variabel $dataPengawas kosong)
                    
                    echo "<tr><td colspan='8'>Data pengawas tidak tersedia.</td></tr>";
                    // Menampilkan pesan bahwa data pengawas tidak tersedia, dan menyatukan 8 kolom tabel
                }
                ?>
            </tbody>
        </table>
        <!-- Akhir tabel untuk Data Penggantian Pengawas Ujian -->

        <br><hr>
        <!-- Menambahkan spasi vertikal (break line) dan garis horizontal (horizontal rule) sebagai pemisah antara dua tabel -->
        
        <h4 style="text-align: center;">Data Laporan Kerja Lembur</h4>
        <!-- Menampilkan judul untuk bagian "Data Laporan Kerja Lembur", dengan teks yang dirata-tengah (text-align: center) -->
        
        <table class="table" border="1px">
        <!-- Membuat tabel kedua untuk laporan kerja lembur, dengan kelas "table" dari Bootstrap dan border sebesar 1px -->
        
    <thead class="thead-blue">
        <!-- Bagian header tabel kedua -->
                <tr>
                    <!-- Membuat baris pada bagian header tabel -->
                    <th scope="col">ID</th>
                    <!-- Kolom untuk menampilkan ID laporan kerja lembur -->
                    <th scope="col">Tanggal Laporan</th>
                    <!-- Kolom untuk menampilkan tanggal laporan kerja lembur -->
                    <th scope="col">Waktu</th>
                    <!-- Kolom untuk menampilkan waktu laporan kerja lembur -->
                    <th scope="col">Uraian Pekerjaan</th>
                    <!-- Kolom untuk menampilkan uraian pekerjaan lembur -->
                    <th scope="col">Keterangan</th>
                    <!-- Kolom untuk menampilkan keterangan terkait lembur -->
                    <th scope="col">Nama Dosen</th>
                    <!-- Kolom untuk menampilkan nama dosen yang terkait dengan pekerjaan lembur -->
                </tr>
    </thead>
            
        <tbody>
        <?php
            if (!empty($dataLaporan)) {
            // Memeriksa apakah variabel $dataLaporan tidak kosong
            $no = 1;
            // Inisialisasi variabel $no dengan nilai 1, meskipun tidak digunakan dalam kode yang diberikan
                    
            foreach ($dataLaporan as $x) {
            // Melakukan loop pada setiap item dalam array $dataLaporan
                    
                echo "<tr>
                <td>{$x['id_lembur']}</td>
                <!-- Menampilkan ID lembur dari data laporan -->
                <td>{$x['hari_tgl_laporan']}</td>
                <!-- Menampilkan hari dan tanggal laporan lembur -->
                <td>{$x['waktu']}</td>
                <!-- Menampilkan waktu laporan lembur -->
                <td>{$x['uraian_pekerjaan']}</td>
                <!-- Menampilkan uraian pekerjaan yang dilakukan saat lembur -->
                <td>{$x['keterangan']}</td>
                <!-- Menampilkan keterangan tambahan terkait lembur -->
                <td>{$x['nama_dosen']}</td>
                <!-- Menampilkan nama dosen yang terkait dengan pekerjaan lembur -->
            </tr>";
            }
            } else {
            // Jika tidak ada data laporan lembur yang tersedia (variabel $dataLaporan kosong)
            echo "<tr><td colspan='6'>Data laporan lembur tidak tersedia.</td></tr>";
            // Menampilkan pesan bahwa data laporan lembur tidak tersedia, dan menyatukan 6 kolom tabel
            }
            ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
```
Kode di atas menggunakan PHP untuk menampilkan semua data Penggantian Pengawas Ujian dan Laporan Lembur dalam bentuk tabel.
             
- Hasil Output:
![alt text](tampilAll1.png)
![alt text](tampilAll2.png)
-------------------------------------------------------------------------------------------------------------------
### 7. Dashboard menampilkan data tabel Penggantian Pengawas Ujian dimana hanya kategori unit kerja tertentu seperti Bidang Kemahasiswaan, Bidang SAINS Akademik, dan Bidang Mechine Learning (Bootstrap dengan Navbar)

#### 1. Bidang Kemahasiswaan
- Code Full:
```php
<?php
require_once('pengawas.php');
require_once('unitKerja.php');

// Membuat instansiasi objek dari class Pengawas
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang Kemahasiswaan');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Unit Kerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>

<div class="container mt-4">
    <h4 style="text-align: center;">Data Unit Kerja Bidang Kemahasiswaan</h4>

    <?php if (!empty($dataUnit)): ?>
    <table class="table" border="1px">
        <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Pengawas Diganti</th>
                <th scope="col">Unit Kerja</th>
                <th scope="col">Hari/Tanggal Penggantian</th>
                <th scope="col">Jam Penggantian</th>
                <th scope="col">Ruang</th>
                <th scope="col">Nama Pengawas Pengganti</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataUnit as $x) {
                echo "<tr>
                    <td>{$x['id_pengganti']}</td>
                    <td>{$x['nama_pengawas_diganti']}</td>
                    <td>{$x['unit_kerja']}</td>
                    <td>{$x['hari_tgl_penggantian']}</td>
                    <td>{$x['jam']}</td>
                    <td>{$x['ruang']}</td>
                    <td>{$x['nama_pengawas_pengganti']}</td>
                    <td>{$x['nama_dosen']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center">Data Unit Kerja tidak tersedia.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```
- Berikut adalah hasil outputnya:

![alt text](bidangKmhs.png)
#### 2. Bidang Bidang SAINS Akademik
- Code full:

```php
<?php
require_once('pengawas.php');
require_once('unitKerja.php');

// Membuat instansiasi objek dari class Pengawas
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang SAINS Akademik');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Unit Kerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>

<div class="container mt-4">
    <h4 style="text-align: center;">Data Unit Kerja Bidang SAINS Akademik</h4>

    <?php if (!empty($dataUnit)): ?>
    <table class="table" border="1px">
        <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Pengawas Diganti</th>
                <th scope="col">Unit Kerja</th>
                <th scope="col">Hari/Tanggal Penggantian</th>
                <th scope="col">Jam Penggantian</th>
                <th scope="col">Ruang</th>
                <th scope="col">Nama Pengawas Pengganti</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataUnit as $x) {
                echo "<tr>
                    <td>{$x['id_pengganti']}</td>
                    <td>{$x['nama_pengawas_diganti']}</td>
                    <td>{$x['unit_kerja']}</td>
                    <td>{$x['hari_tgl_penggantian']}</td>
                    <td>{$x['jam']}</td>
                    <td>{$x['ruang']}</td>
                    <td>{$x['nama_pengawas_pengganti']}</td>
                    <td>{$x['nama_dosen']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center">Data Unit Kerja tidak tersedia.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```

- Berikut Hasil Outputnya:


#### 3. Bidang Mechine Learning
- Code Full:

```php
<?php
require_once('pengawas.php');
require_once('unitKerja.php');

// Membuat instansiasi objek dari class Pengawas
$unitkrj = new unitKerja();
$dataUnit = $unitkrj->tampilData('Bidang Mechine Learning');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Unit Kerja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>

<div class="container mt-4">
    <h4 style="text-align: center;">Data Unit Kerja Bidang Machine Learning</h4>

    <?php if (!empty($dataUnit)): ?>
    <table class="table" border="1px">
        <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Pengawas Diganti</th>
                <th scope="col">Unit Kerja</th>
                <th scope="col">Hari/Tanggal Penggantian</th>
                <th scope="col">Jam Penggantian</th>
                <th scope="col">Ruang</th>
                <th scope="col">Nama Pengawas Pengganti</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataUnit as $x) {
                echo "<tr>
                    <td>{$x['id_pengganti']}</td>
                    <td>{$x['nama_pengawas_diganti']}</td>
                    <td>{$x['unit_kerja']}</td>
                    <td>{$x['hari_tgl_penggantian']}</td>
                    <td>{$x['jam']}</td>
                    <td>{$x['ruang']}</td>
                    <td>{$x['nama_pengawas_pengganti']}</td>
                    <td>{$x['nama_dosen']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center">Data Unit Kerja tidak tersedia.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```

- Hasil Output:


-----------------------------------------------------

### 8. Dashboard menampilkan data tabel Laporan Kerja Lembur dimana hanya kategori nama dosen tertentu seperti Devi Aryanii, Chiko Jerome, dan Vannya S.Pd., M.Pd., Kom (Bootstrap dengan Navbar).

#### 1. Dosen Devi Aryanii
- Code full:

```php
<?php
require_once('laporan.php');
require_once('dosen.php');

// Membuat instansiasi objek dari class Dosen
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Devi Aryanii');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Tanggal Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>
<div class="container mt-4">
<h4 style="text-align: center;">Data Laporan Kerja Lembur</h4>
    <table class="table">
  <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Waktu</th>
                <th scope="col">Uraian Pekerjaan</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($dataDosen)) {
                $no = 1;
                foreach ($dataDosen as $x) {
                    echo "<tr>
                        <td>{$x['id_lembur']}</td>
                        <td>{$x['hari_tgl_laporan']}</td>
                        <td>{$x['waktu']}</td>
                        <td>{$x['uraian_pekerjaan']}</td>
                        <td>{$x['keterangan']}</td>
                        <td>{$x['nama_dosen']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data laporan lembur tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```

- Hasil output:
-----------------------------------------------------

#### 2. Dosen Chiko Jerome
- Code full:

```php
<?php
require_once('laporan.php');
require_once('dosen.php');

// Membuat instansiasi objek dari class Dosen
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Chiko Jerome');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Tanggal Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center; 
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>
<div class="container mt-4">
<h4 style="text-align: center;">Data Laporan Kerja Lembur</h4>
    <table class="table">
  <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Waktu</th>
                <th scope="col">Uraian Pekerjaan</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($dataDosen)) {
                $no = 1;
                foreach ($dataDosen as $x) {
                    echo "<tr>
                        <td>{$x['id_lembur']}</td>
                        <td>{$x['hari_tgl_laporan']}</td>
                        <td>{$x['waktu']}</td>
                        <td>{$x['uraian_pekerjaan']}</td>
                        <td>{$x['keterangan']}</td>
                        <td>{$x['nama_dosen']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data laporan lembur tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```

- Hasil output:
-----------------------------------------------------

#### 3. Dosen Vannya S.Pd., M.Pd.,Kom
- Code full:

```php
<?php
require_once('laporan.php');
require_once('dosen.php');

// Membuat instansiasi objek dari class Dosen
$dosen = new Dosen();
$dataDosen = $dosen->tampilData('Vannya S.Pd., M.Pd., Kom');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Tanggal Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .thead-blue {
            background-color: #006666;
            text-align: center;
            color: white;
        }
        tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">

<!-- Navbar menggunakan Bootstrap 5 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
<div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Menu untuk Semua Data -->
            <li class="nav-item">
                <a class="nav-link" href="tampilAll.php">Semua Data</a>
            </li>

            <!-- Dropdown untuk Data Unit Kerja -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Data Unit Kerja
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <li><a class="dropdown-item" href="bidangKmhs.php">Bidang Kemahasiswaan</a></li>
                    <li><a class="dropdown-item" href="bidangSA.php">Bidang SAINS Akademik</a></li>
                    <li><a class="dropdown-item" href="bidangML.php">Bidang Machine Learning</a></li>
                </ul>
            </li>

            <!-- Dropdown untuk Tanggal Laporan -->
            <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen       
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <li><a class="dropdown-item" href="dosenDevi.php">Dosen Devi Aryani</a></li>
                    <li><a class="dropdown-item" href="dosenVannya.php">Dosen Vannya</a></li>
                    <li><a class="dropdown-item" href="dosenChiko.php">Dosen Chiko Jerome</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

</nav>
<div class="container mt-4">
<h4 style="text-align: center;">Data Laporan Kerja Lembur</h4>
    <table class="table">
  <thead class="thead-blue">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Waktu</th>
                <th scope="col">Uraian Pekerjaan</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nama Dosen</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($dataDosen)) {
                $no = 1;
                foreach ($dataDosen as $x) {
                    echo "<tr>
                        <td>{$x['id_lembur']}</td>
                        <td>{$x['hari_tgl_laporan']}</td>
                        <td>{$x['waktu']}</td>
                        <td>{$x['uraian_pekerjaan']}</td>
                        <td>{$x['keterangan']}</td>
                        <td>{$x['nama_dosen']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data laporan lembur tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

```

- Hasil output:

-----------------------------------------------------
