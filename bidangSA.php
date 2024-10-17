<?php
require_once('pengawas.php');
require_once('unitKerja.php');

// Membuat instansiasi objek dari class unitKerja
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
