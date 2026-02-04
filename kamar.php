<?php
// jalankan session
session_start();
require 'database.php';
require 'kelola-data.php';


// cek jika tombol simpan di tekan
if (isset($_POST['simpan'])) {

    // jalankan fungsi tambahKamar
    if (tambahDataKamar($_POST) > 0) {
        $berhasil = true;
    } else {
        $gagal = true;
    }
}
if (isset($_POST['simpan_ubah'])) {

    // jalankan fungsi tambahKamar
    if (editDataKamar($_POST) > 0) {
        $berhasil_ubah = true;
    } else {
        $gagal_ubah = true;
    }
}

// query tampilkan semu data kamar

$data_kamar = semuaData("SELECT * FROM tabel_kamar ORDER BY id_kamar DESC");


?>

<!-- kode warna button tambah data : #a4bcda -->
<!-- kode warna button ubah edit data : #7bdcc3 -->



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
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
                    <a class="nav-link active" href="kamar.php">KAMAR</a>
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
                    <li class="breadcrumb-item"><a href="#">Halaman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kamar</li>
                </ol>
            </nav>
        </div>


        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row my-2">
                    <div class="col-lg">
                        <button class="btn text-white float-end" name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #a4bcda;"><i class="bi bi-plus-lg"></i> Tambah data Kamar</button>
                    </div>
                </div>

                <!-- alert web -->
                <?php if (isset($berhasil)) : ?>
                    <div class="alert alert-success border-0">
                        Data kamar <b>Berhasil Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal)) : ?>
                    <div class="alert alert-danger border-0">
                        Data kamar <b>Gagal Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($berhasil_ubah)) : ?>
                    <div class="alert alert-success border-0">
                        Data kamar <b>Berhasil Diubah !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal_ubah)) : ?>
                    <div class="alert alert-danger border-0">
                        Data kamar <b>Gagal Diubah ! !</b>
                    </div>
                <?php endif ?>


                <div class="card shadow-sm border-0 p-2 my-2">
                    <!-- tabel data kamar -->
                    <table id="myTable" class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>No Kamar</th>
                                <th>Ukuran</th>
                                <th>Kapasitas</th>
                                <th>Tarif</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_kamar as $kamar) : ?>
                                <tr>
                                    <td class="py-4"><?= $no++ ?></td>
                                    <td class="p-1"><img src="img/foto-kamar/<?= $kamar['foto_kamar'] ?>" style="width: 60px; height: 60px;" class="img-fluid rounded"></td>
                                    <td class="py-4"><?= $kamar['nama_kamar'] ?></td>
                                    <td class="py-4"><?= $kamar['ukuran_kamar'] ?></td>
                                    <td class="py-4"><?= $kamar['kapasitas'] ?></td>
                                    <td class="py-4">Rp. <?= number_format($kamar['harga_per_bulan']) ?></td>
                                    <td class="fw-bold py-4 <?= ($kamar['status'] == 'Tersedia') ? 'text-success' : 'text-danger' ?> "><?= $kamar['status'] ?></td>

                                    <td class="py-4">

                                        <button data-bs-toggle="modal" data-bs-target="#ubah<?= $kamar['id_kamar'] ?>" class="btn btn-sm text-white" style="background-color: #7bdcc3;"><i class="bi bi-pencil-square"></i> </button>

                                        <a href="hapus-kamar.php?id=<?= $kamar['id_kamar'] ?> " class="btn btn-sm text-white" style="background-color: #dc5746;"><i class="bi bi-trash"></i> </a>

                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <h6 class="text-end mt-2 mx-3">
                        <?php $query = mysqli_query($db, "SELECT * FROM tabel_kamar") ?>
                        Total Kamar : <strong> <?= $query->num_rows ?> </strong>
                    </h6>

                </div>
            </div>
        </div>


        <!-- Modal tambah data kamar -->
        <div class="modal fade border-0" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog border-0">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data Kamar Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body border-0">
                            <div class="form-group">
                                <label for="nama">Nomor Kamar</label>
                                <input type="text" name="nama" class="form-control rounded-0" placeholder="Kamar 01/02  ">
                            </div>

                            <div class="form-group">
                                <label for="ukuran">Ukuran Kamar</label>
                                <select name="ukuran" class="form-select rounded-0">
                                    <option value=""> pilih ukuran </option>
                                    <option value="3 x 2.5m">3 x 2.5m</option>
                                    <option value="3 x 2.5m">4 x 4m</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kapasitas">Kapasitas</label>
                                <select name="kapasitas" class="form-select rounded-0">
                                    <option value=""> pilih </option>
                                    <option value="2 Orang">2 Orang</option>
                                    <option value="3 Orang">3 Orang</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="harga">Harga per Bulan</label>
                                <input type="text" name="harga" class="form-control rounded-0" placeholder="Harga per Bulan">
                            </div>

                            <div class="form-group">
                                <label for="status">Status Kamar</label>
                                <select name="status" class="form-select rounded-0">
                                    <option value=""> status </option>
                                    <option value="Sudah Terisi">Sudah Terisi</option>
                                    <option value="Tersedia">Tersedia</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto Kamar</label>
                                <input type="file" name="foto" class="form-control rounded-0">
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

        <!-- Modal ubah data kamar -->
        <?php foreach ($data_kamar as $kamar) : ?>
            <div class="modal fade" id="ubah<?= $kamar['id_kamar'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah data Kamar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar'] ?>">
                            <input type="hidden" name="foto_lama" value="<?= $kamar['foto_kamar'] ?>">

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama Kamar</label>
                                    <input type="text" name="nama" class="form-control rounded-0 fw-bold" value="<?= $kamar['nama_kamar'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="ukuran">Ukuran Kamar</label>
                                    <select name="ukuran" class="form-select rounded-0 fw-bold">
                                        <option value=""> pilih ukuran </option>
                                        <option value="<?= $kamar['ukuran_kamar'] ?>" <?= ($kamar['ukuran_kamar'] == '3 x 2.5m') ? 'selected' : '' ?>>3 x 2.5m</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <select name="kapasitas" class="form-select rounded-0 fw-bold">
                                        <option value=""> pilih </option>
                                        <option value="2 Orang" <?= ($kamar['kapasitas'] == '2 Orang') ? 'selected' : '' ?>>2 Orang</option>
                                        <option value="3 Orang" <?= ($kamar['kapasitas'] == '3 Orang') ? 'selected' : '' ?>>3 Orang</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga per Bulan</label>
                                    <input type="text" name="harga" class="form-control rounded-0 fw-bold" value=" <?= $kamar['harga_per_bulan'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="status">Status Kamar</label>
                                    <select name="status" class="form-select rounded-0 fw-bold">
                                        <option> status </option>
                                        <option value="Sudah Terisi" <?= ($kamar['status'] == 'Sudah Terisi') ? 'selected' : ''  ?>>Sudah Terisi</option>
                                        <option value="Tersedia" <?= ($kamar['status'] == 'Tersedia') ? 'selected' : ''  ?>>Tersedia</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto Kamar</label>
                                    <input type="file" name="foto" class="form-control rounded-0">
                                </div>

                                <img src="img/foto-kamar/<?= $kamar['foto_kamar'] ?>" class="img-fluid rounded my-1" style="width: 100px; height: 100px;">
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

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable searching
                "ordering": true, // Enable sorting
                "info": true, // Show table info
                "lengthChange": true, // Enable length change dropdown
                "responsive": true, // Enable responsive design
                "language": {
                    "emptyTable": "Tidak ada data tersedia di tabel",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(disaring dari _MAX_ total entri)",
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ditemukan data yang sesuai"
                }
            });
        });
    </script>




</body>

</html>