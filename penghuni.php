<?php
// jalankan session
session_start();
require 'database.php';
require 'kelola-data.php';


// cek jika tombol simpan di tekan
if (isset($_POST['simpan'])) {

    // jalankan fungsi tambahKamar
    if (tambahDataPenghuni($_POST) > 0) {
        $berhasil = true;
    } else {
        $gagal = true;
    }
}
if (isset($_POST['simpan_ubah'])) {

    // jalankan fungsi tambahKamar
    if (editPenghuni($_POST) > 0) {
        $berhasil_ubah = true;
    } else {
        $gagal_ubah = true;
    }
}

// query tampilkan semua data kamar
$data_kamar = semuaData("SELECT * FROM tabel_kamar ORDER BY id_kamar DESC");

// query tampilkan semua data penghuni
$data_penghuni  = semuaData('SELECT * FROM tabel_penghuni JOIN tabel_kamar ON tabel_penghuni.id_kamar = tabel_kamar.id_kamar ORDER BY id_penghuni DESC');

?>

<!-- kode warna button tambah data : #a4bcda -->
<!-- kode warna button ubah edit data : #7bdcc3 -->



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penghuni</title>
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
                </ol>
            </nav>
        </div>


        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="row my-2">
                    <div class="col-lg">
                        <button class="btn btn-sm text-white float-end" name="submit" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="background-color: #a4bcda;"><i class="bi bi-plus-lg"></i> Tambah Penghuni <span class="badge text-bg-warning">1</span> </button>

                        <a href="scan.php" class="btn btn-sm float-end btn-primary mx-2"> <i class="bi bi-upc-scan"></i> Scan Kode <span class="badge text-bg-warning">2</span> </a>

                    </div>
                </div>

                <!-- alert web -->
                <?php if (isset($berhasil)) : ?>
                    <div class="alert alert-success border-0">
                        Data <b>Berhasil Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal)) : ?>
                    <div class="alert alert-danger border-0">
                        Data <b>Gagal Ditambahkan !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($berhasil_ubah)) : ?>
                    <div class="alert alert-success border-0">
                        Data <b>Berhasil Diubah !</b>
                    </div>
                <?php endif ?>
                <?php if (isset($gagal_ubah)) : ?>
                    <div class="alert alert-danger border-0">
                        Data <b>Gagal Diubah ! !</b>
                    </div>
                <?php endif ?>


                <div class="card shadow-sm border-0 p-2 my-2">
                    <!-- tabel data kamar -->
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama </th>
                                <th>No HP / WA</th>
                                <th>Registrasi</th>
                                <th>Kamar</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            foreach ($data_penghuni as $penghuni) :

                                // Mengubah format tanggal pembayaran
                                $tgl_reg = new DateTime($penghuni['tgl_registrasi']);

                                // Array untuk mengganti bulan Inggris ke bahasa Indonesia
                                $bulanIndonesia = [
                                    'January' => 'Januari',
                                    'February' => 'Februari',
                                    'March' => 'Maret',
                                    'April' => 'April',
                                    'May' => 'Mei',
                                    'June' => 'Juni',
                                    'July' => 'Juli',
                                    'August' => 'Agustus',
                                    'September' => 'September',
                                    'October' => 'Oktober',
                                    'November' => 'November',
                                    'December' => 'Desember'
                                ];

                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $penghuni['nama_penghuni'] ?></td>
                                    <td><?= $penghuni['no_tlp'] ?></td>
                                    <td>
                                        <?= $tgl_reg->format('d') . ' ' . $bulanIndonesia[$tgl_reg->format('F')] . ' ' . $tgl_reg->format('Y') ?>
                                    </td>
                                    <td> <?= $penghuni['nama_kamar'] ?></td>
                                    <td> <?= $penghuni['alamat'] ?></td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#ubahData<?= $penghuni['id_penghuni'] ?>" class="btn btn-sm text-white" style="background-color: #7bdcc3;"><i class="bi bi-pencil-square"></i> </button>
                                        <a href="hapus-penghuni.php?id=<?= $penghuni['id_penghuni'] ?> " class="btn btn-sm text-white" style="background-color: #dc5746;"><i class="bi bi-trash"></i> </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal tambah data penghuni -->
        <div class="modal fade border-0" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog border-0">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah data Penghuni Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body border-0">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control rounded-0" placeholder="Nama Lengkap">
                            </div>

                            <div class="form-group">
                                <label for="tlp">Nomor Tlp / WA (Contoh: +628xx) </label>
                                <input type="text" name="tlp" class="form-control rounded-0" value="+62">
                            </div>

                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Registrasi / Tanggal Masuk</label>
                                <input type="date" name="tgl_masuk" class="form-control rounded-0" placeholder="+62 ">
                            </div>

                            <div class="form-group">
                                <label for="id_kamar">Nomor Kamar</label>
                                <select name="id_kamar" class="form-select rounded-0">
                                    <option value=""> pilih kamar </option>
                                    <?php foreach ($data_kamar as $kamar) : ?>
                                        <option value="<?= $kamar['id_kamar'] ?>">
                                            <?= $kamar['nama_kamar'] ?> |
                                            <?= $kamar['status'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat"></textarea>
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
        <!-- akhir modal tambah data -->

        <!-- Modal ubah data penghuni -->
        <?php foreach ($data_penghuni as $penghuni) : ?>
            <div class="modal fade border-0" id="ubahData<?= $penghuni['id_penghuni'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog border-0">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah data Penghuni</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_penghuni" value="<?= $penghuni['id_penghuni'] ?>">
                            <div class="modal-body border-0">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control rounded-0 fw-bold" value="<?= $penghuni['nama_penghuni'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="tlp">Nomor Tlp / WA</label>
                                    <input type="text" name="tlp" class="form-control rounded-0 fw-bold" value="<?= $penghuni['no_tlp'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Registrasi / Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control rounded-0 fw-bold " value="<?= $penghuni['tgl_registrasi'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="id_kamar">Nomor Kamar</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control rounded-0 fw-bold" value="<?= $penghuni['nama_kamar'] ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <select name="id_kamar" class="form-select rounded-0" required>
                                                <option value=""> pilih kamar </option>
                                                <?php foreach ($data_kamar as $kamar) : ?>
                                                    <option value="<?= $kamar['id_kamar'] ?>">
                                                        <?= $kamar['nama_kamar'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control fw-bold" rows="2"><?= $penghuni['alamat'] ?> </textarea>
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
        <!-- akhir modal ubah data -->




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