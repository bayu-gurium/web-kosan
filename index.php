<?php

require 'database.php';
require 'kelola-data.php';

// query data Kamar
$data_kamar = semuaData("SELECT * FROM tabel_kamar");
// query data Fasilitas
$data_fasilitas = semuaData("SELECT * FROM tabel_fasilitas");

?>

<!-- kode warna -->
<!-- text-orange : #f16127 -->
<!-- text-hijau : #18e87b -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kos Batak</title>
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

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3 shadow-sm bg-warning">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#beranda" style="color: #f16127;">MAINTENANCE WEBSITE</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active mx-3" aria-current="page" href="#beranda">Beranda</a>
                    <a class="nav-link active mx-3" aria-current="page" href="#fasilitas">Fasilitas</a>
                    <a class="nav-link active mx-3" aria-current="page" href="#kamar">Kamar</a>
                    <a class="nav-link active mx-3" aria-current="page" href="login.php">Login</a>
                    <a href="https://wa.me/6281248374924" class="btn btn-success border-0" target="_blank" style="background-color: #18e87b;"><i class="bi bi-whatsapp"></i> Whatsapp Admin</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <!-- section 1 -->
    <section id="beranda" class="bg-light py-2">
        <div class="container">
            <div class="row align-items-center" style="height: 100vh;">
                <div class="col-lg-6">
                    <h6>Selamat Datang !!</h6>
                    <h1 style="color: #f16127;">Kosan Batak</h1>
                    <h4>Tinggal di Tempat yang Tepat, dengan Harga yang Pas !</h4>

                    <!-- card -->
                    <div class="card shadow bg-warning-subtle border-0 p-2 my-2 mt-3">
                        <div class="row text-center">
                            <div class="col-4">
                                <h6>Total Kamar</h6>
                                <h5 class="fw-bold"><?= jumlahKamar() ?></h5>
                            </div>
                            <div class="col-4">
                                <h6>Terisi</h6>
                                <h5 class="fw-bold"><?= jumlahKamarTerisi() ?></h5>
                            </div>
                            <div class="col-4">
                                <h6>Tersedia</h6>
                                <h5 class="fw-bold"><?= jumlahKamarTersedia() ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex d-none">
                    <img src="img/heero-1.png" class="img-fluid text-end rounded mt-5">
                </div>
            </div>
        </div>
    </section>
    <!-- akhir section-1 -->

    <!-- section-2 -->
    <section id="fasilitas" class="py-2">
        <div class="container mt-5">

            <div class="row align-items-center mt-5" style="height: 15vh;">
                <h3 class="text-center" style="color: #f16127;">Fasilitas Kosan Batak</h3>
            </div>
            <div class="row justify-content-center">
                <?php if ($data_fasilitas) : ?>
                    <?php foreach ($data_fasilitas as $fasilitas) : ?>
                        <div class="col-lg-3">
                            <div class="card shadow-sm border-0 p-2 my-2">
                                <div class="row">
                                    <img src="img/foto-kamar/<?= $fasilitas['gambar_fasilitas'] ?>" class="img-fluid" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="row mt-2">
                                    <h4 class="text-center"><?= $fasilitas['nama_fasilitas'] ?></h4>
                                    <small class="text-muted"><?= $fasilitas['deskripsi'] ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                <?php else : ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="alert alert-warning text-center">
                                <small>Fasilitas belum tersedia !!</small>
                            </div>
                        </div>
                    </div>
                <?php endif ?>


                <!-- map -->
                <div class="row mt-2">
                    <h4>Detail Lokasi Kosan Batak</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d494.7742267191882!2d128.18921989156323!3d-3.6614262386556597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6cefedff77bd3d%3A0x66bcfcb79af50d4e!2sKos%20Batak!5e1!3m2!1sid!2sid!4v1735964109689!5m2!1sid!2sid" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
    </section>
    <!-- akhir section-2 -->

    <!-- section-3 -->
    <section id="kamar" class="py-2 bg-light" style="height: 100vh;">

        <div class="container mt-5">
            <div class="row align-items-center mt-5" style="height: 15vh;">
                <h3 class="text-center" style="color: #f16127;">Detail Kamar Kosan Batak</h3>
            </div>

            <div class="row justify-content-center ">
                <?php if ($data_kamar) : ?>
                    <?php foreach ($data_kamar as $kamar) : ?>
                        <div class="col-lg-3">
                            <div class="card shadow border-0 p-2 my-2">
                                <div class="row">
                                    <img src="img/foto-kamar/<?= $kamar['foto_kamar'] ?>" class="img-fluid" style="height: 150px; object-fit: cover;">
                                </div>
                                <div class="row mt-2 text-center">
                                    <h5><?= $kamar['nama_kamar'] ?></h5>

                                    <strong>
                                        <h4>Rp. <?= number_format($kamar['harga_per_bulan']) ?> </h4>
                                    </strong>

                                    <small><?= $kamar['ukuran_kamar'] ?></small>
                                    <h5 class="text-uppercase <?= ($kamar['status'] == 'Tersedia') ? 'text-success' : 'text-danger' ?> "><?= $kamar['status'] ?></h5>

                                </div>
                                <a href="https://wa.me/6281248374924?text=Halo%2C%20saya%20tertarik%20dengan%20kos-kosan%20Anda.%20Apakah%20kamar%20masih%20tersedia%3F" class=" btn btn-sm mt-2 text-white" target="_blank" style="background-color: #18e87b;">
                                    <i class="bi bi-whatsapp"></i>
                                    Cek Sediaan Kamar
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="alert alert-warning text-center">
                                <small>Kamar belum tersedia !!</small>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>

    </section>
    <!-- akhir section-3 -->

    <!-- section-4 -->
    <section class="py-2 bg-light">
        <div class="container mt-5">
            <div class="row align-items-center mt-5">
                <small>Web Buid with ❤️ by <a href="">Bayu Gurium</a></small>
            </div>
        </div>
    </section>
    <!-- akhir section-4 -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>