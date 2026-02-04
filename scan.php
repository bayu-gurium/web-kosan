<?php
// jalankan session
session_start();
require 'database.php';
require 'kelola-data.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan Kode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-secondary-subtle shadow-sm p-3">
        <div class="container px-lg-0 px-4">
            <a class="navbar-brand fw-bold" href="dashboard.php">Kos Batak</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" aria-current="page" href="dashboard.php">DASHBOARD</a>
                    <a class="nav-link active" href="penghuni.php">PENGHUNI</a>
                    <a class="nav-link" href="kamar.php">KAMAR</a>
                    <a class="nav-link" href="fasilitas.php">FASILITAS</a>
                    <a class="nav-link" href="tagihan.php">TAGIHAN</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="keluar.php">Keluar</a></li>
                        </ul>
                    </li>

                </div>
            </div>
        </div>
    </nav>
    <!-- navbar -->

    <div class="container">

        <!-- breadcrumb -->
        <div class="row mt-4 p-4 p-lg-0">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Halaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Penghuni</li>
                    <li class="breadcrumb-item active" aria-current="page">Scan Barcode</li>
                </ol>
            </nav>
        </div>


        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row my-2">
                    <div class="col-lg">

                        <div class="alert alert-warning">
                            <small> <strong><i class="bi bi-exclamation-circle-fill"></i> :</strong> Setiap penghuni/anak kos baru harus memiliki Nomor WhatsApp dari admin, dikarenakan tagihan bulanan akan di kirim melalui WhatsApp. <strong>Scan dibawah ini.</strong></small>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-2 my-2">
                    <img src="img/code.png" class="img-fluid">
                </div>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>