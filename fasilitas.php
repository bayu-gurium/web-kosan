<?php
// jalankan session
session_start();
require 'database.php';
require 'kelola-data.php';


// cek jika tombol simpan di tekan
if (isset($_POST['simpan'])) {

    // jalankan fungsi tambah Fasilitas
    if (tambahDataFasilitas($_POST) > 0) {
        $berhasil = true;
    } else {
        $gagal = true;
    }
}
if (isset($_POST['simpan_ubah'])) {

    // jalankan fungsi edit Fasilitas
    if (editDataFasilitas($_POST) > 0) {
        $berhasil_ubah = true;
    } else {
        $gagal_ubah = true;
    }
}

// query tampilkan semua data kamar

$data_fasilitas = semuaData("SELECT * FROM tabel_fasilitas ORDER BY id_fasilitas DESC");


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas Kos</title>
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
                    <a class="nav-link" href="penghuni.php">PENGHUNI</a>
                    <a class="nav-link" href="kamar.php">KAMAR</a>
                    <a class="nav-link active" href="fasilitas.php">FASILITAS</a>
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
                    <li class="breadcrumb-item"><a href="#">Halaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Fasilitas</li>
                </ol>
            </nav>
        </div>



        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row my-2">
                    <div class="col-lg">
                        <button class="btn btn text-white float-end" name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #a4bcda;"><i class="bi bi-plus-lg"></i> Tambah data Fasilitas</button>
                    </div>
                </div>

                <!-- alert web -->
                <?php if (isset($berhasil)) : ?>
                    <div class="alert alert-success border-0">
                        Data Fasilitas <b>Berhasil Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal)) : ?>
                    <div class="alert alert-danger border-0">
                        Data Fasilitas <b>Gagal Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($berhasil_ubah)) : ?>
                    <div class="alert alert-success border-0">
                        Data Fasilitas <b>Berhasil Diubah !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal_ubah)) : ?>
                    <div class="alert alert-danger border-0">
                        Data Fasilitas <b>Gagal Diubah ! !</b>
                    </div>
                <?php endif ?>


                <div class="card shadow-sm border-0 p-2 my-2">
                    <!-- tabel data kamar -->
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Fasilitas</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_fasilitas as $fasilitas) : ?>
                                <tr>
                                    <td class="py-4"><?= $no++ ?></td>
                                    <td class="p-1"><img src="img/foto-kamar/<?= $fasilitas['gambar_fasilitas'] ?>" style="width: 60px; height: 60px;" class="img-fluid rounded"></td>
                                    <td class="py-4 fw-bold"><?= $fasilitas['nama_fasilitas'] ?></td>
                                    <td class="py-4"><?= $fasilitas['deskripsi'] ?></td>

                                    <td class="py-4">

                                        <!-- <button type="submit" name="simpan" class="btn text-white" style="background-color: #7bdcc3;"><i class="bi bi-floppy"></i> Simpan</button>
                                        <button type="button" class="btn text-white" style="background-color: #dc5746;" data-bs-dismiss="modal">Batal</button> -->

                                        <button style="background-color: #7bdcc3;" data-bs-toggle="modal" data-bs-target="#ubah<?= $fasilitas['id_fasilitas'] ?>" class="btn btn-sm text-white"><i class="bi bi-pencil-square"></i> </button>

                                        <a style="background-color: #dc5746;" href="hapus-fasilitas.php?id=<?= $fasilitas['id_fasilitas'] ?> " class="btn btn-sm text-white"><i class="bi bi-trash"></i> </a>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal tambah data fasilitas -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data Fasilitas Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Fasiltas</label>
                                <input type="text" name="nama" class="form-control rounded-0" placeholder="Nama Fasilitas">
                            </div>

                            <div class="form-group">
                                <label for="foto">Gambar Fasilitas</label>
                                <input type="file" name="gambar" class="form-control rounded-0">
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn text-white" style="background-color: #7bdcc3;"><i class="bi bi-floppy"></i> Simpan</button>
                            <button type="button" class="btn text-white" style="background-color: #dc5746;" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- akhir modal tambah data fasilitas -->

        <!-- Modal ubah data fasilitas -->
        <?php foreach ($data_fasilitas as $fasilitas) : ?>
            <div class="modal fade" id="ubah<?= $fasilitas['id_fasilitas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah data Fasilitas Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_fasilitas" value="<?= $fasilitas['id_fasilitas'] ?>">
                            <input type="hidden" name="gambar_lama" value="<?= $fasilitas['gambar_fasilitas'] ?>">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Fasiltas</label>
                                    <input type="text" name="nama" class="form-control rounded-0 fw-bold" value="<?= $fasilitas['nama_fasilitas'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="foto">Gambar Fasilitas</label>
                                    <input type="file" name="gambar" class="form-control rounded-0">
                                </div>

                                <div class="form-group my-1">
                                    <img src="img/foto-kamar/<?= $fasilitas['gambar_fasilitas'] ?>" class="img_fluid" style="width: 100px; height: 100px;">
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control fw-bold"><?= $fasilitas['deskripsi'] ?></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="simpan_ubah" class="btn text-white" style="background-color: #7bdcc3;"><i class="bi bi-floppy"></i> Simpan</button>
                                <button type="button" class="btn text-white" style="background-color: #dc5746;" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>