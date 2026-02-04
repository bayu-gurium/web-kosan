<?php
// jalankan session
session_start();
require 'database.php';
require 'kelola-data.php';


// query / ambil data dari tabel tagihan
$data_tagihan = semuaData("SELECT * FROM tagihan_kos JOIN tabel_penghuni ON tagihan_kos.id_penghuni = tabel_penghuni.id_penghuni");


if (isset($_POST['ubah'])) {

    if (ubahTagihan($_POST) > 0) {

        $alert_sukses = true;
    } else {

        $alert_gagal = true;
    }
}


?>

<!-- kode warna button tambah data : #a4bcda -->
<!-- kode warna button ubah edit data : #7bdcc3 -->



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tagihan</title>
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
                    <a class="nav-link" href="kamar.php">KAMAR</a>
                    <a class="nav-link" href="fasilitas.php">FASILITAS</a>
                    <a class="nav-link active" href="tagihan.php">TAGIHAN</a>
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
                    <li class="breadcrumb-item active" aria-current="page">Data Tagihan</li>
                </ol>
            </nav>
        </div>


        <div class="row justify-content-center">
            <div class="col-lg">
                <div class="row my-2">
                    <div class="col-lg">
                        <a href="tambah-tagihan.php" class="btn text-white" style="background-color: #a4bcda;"><i class="bi bi-plus-lg"></i> Tambah data Tagihan</a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-2 my-2">
                    <!-- tabel data kamar -->
                    <table id="myTable" class="display" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah Tagihan</th>
                                <th>Tgl Pembayaran</th>
                                <th>Tgl Dibayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data_tagihan as $tagihan):
                                // Mengubah format tanggal pembayaran
                                $tanggal_pembayaran = new DateTime($tagihan['tanggal_pembayaran']);
                                $tanggal_dibayar = new DateTime($tagihan['tanggal_dibayar']);

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
                                    <td><?= $tagihan['nama_penghuni'] ?></td>
                                    <td>Rp.<?= number_format($tagihan['jumlah_tagihan']) ?></td>

                                    <!-- Menampilkan tanggal pembayaran dalam format indonesia -->
                                    <td>
                                        <?= $tanggal_pembayaran->format('d') . ' ' . $bulanIndonesia[$tanggal_pembayaran->format('F')] . ' ' . $tanggal_pembayaran->format('Y') ?>
                                    </td>

                                    <!-- Menampilkan tanggal dibayar dalam format indonesia -->
                                    <td>
                                        <?= $tanggal_dibayar->format('d') . ' ' . $bulanIndonesia[$tanggal_dibayar->format('F')] . ' ' . $tanggal_dibayar->format('Y') ?>
                                    </td>

                                    <td class="<?= ($tagihan['status_pembayaran'] == 'Sudah Dibayar') ? 'text-success fw-bold' : '' ?>">
                                        <?= $tagihan['status_pembayaran'] ?>
                                    </td>

                                    <td class="text-center">
                                        <!-- Kirim Notifikasi WhatsApp -->
                                        <?php if ($tagihan['status_pembayaran'] == 'Belum Dibayar') : ?>
                                            <form action="kirim-whatsapp.php" method="POST" style="display:inline;">
                                                <input type="hidden" name="nama_penghuni" value="<?= $tagihan['nama_penghuni'] ?>">
                                                <input type="hidden" name="jumlah_tagihan" value="<?= $tagihan['jumlah_tagihan'] ?>">
                                                <input type="hidden" name="tanggal_pembayaran" value="<?= $tanggal_pembayaran->format('d-m-Y') ?>"> <!-- Menggunakan format tanggal sesuai kebutuhan -->
                                                <input type="hidden" name="no_penghuni" value="<?= $tagihan['no_tlp'] ?>">


                                                <!-- pastikan nomor penghuni ada di database -->
                                                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-whatsapp"></i></button>
                                            </form>

                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#konfir<?= $tagihan['id_tagihan'] ?>">Konfirmasi</button>

                                                <a href="hapus-tagihan.php?id=<?= $tagihan['id_tagihan'] ?> " class="btn btn-sm text-white" style="background-color: #dc5746;"><i class="bi bi-trash"></i></a>
                                            </div>
                                        <?php else : ?>
                                            <a href="hapus-tagihan.php?id=<?= $tagihan['id_tagihan'] ?> " class="btn btn-sm text-white" style="background-color: #dc5746;"><i class="bi bi-trash"></i></a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal ubah data tagihan-->
        <?php foreach ($data_tagihan as $tagihan) : ?>
            <div class="modal fade border-0" id="konfir<?= $tagihan['id_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog border-0 modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="alert alert-warning p-0 px-2 ">
                                <small>Pastikan Penghuni kos telah melunasi Tagihan yang di kirimkan</small>
                            </div>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_tagihan" value="<?= $tagihan['id_tagihan'] ?>">
                            <div class="modal-body border-0">
                                <div class="form-group">
                                    <label for="nama">Nama Penghuni</label>
                                    <input type="text" name="nama" class="form-control rounded-0 fw-bold" value="<?= $tagihan['nama_penghuni'] ?>">
                                </div>

                                <!-- - -->
                                <div class="form-group my-1 mt-3">
                                    <label for="status">Status Pembayaran</label>
                                    <select name="status" class="form-select rounded-0">
                                        <option value=""> pilih </option>
                                        <option value="Sudah Dibayar"> Sudah Dibayar</option>
                                        <option value="Belum Dibayar" selected> Belum Dibayar</option>
                                    </select>
                                </div>
                                <!--  -->
                                <!-- - -->
                                <div class="form-group my-1 mt-3">
                                    <label for="tgl_dibayar">Tanggal Dibayar</label>
                                    <input type="date" name="tgl_dibayar" class="form-control rounded-0" required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="ubah" class="btn text-white" style="background-color: #7bdcc3;"><i class="bi bi-floppy"></i> Simpan</button>
                                <button type="button" class="btn text-white" style="background-color: #dc5746;" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>



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