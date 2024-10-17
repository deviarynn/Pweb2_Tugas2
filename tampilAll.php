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
        <!-- Bagian body dari tabel yang akan menampilkan data pengawas -->
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
        <!-- Bagian body dari tabel yang akan menampilkan data laporan lembur -->
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
