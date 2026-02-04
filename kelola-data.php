<?php

require 'database.php';


// KELOLA DATA KAMAR

// tambah data kamar
function tambahDataKamar($data)
{

    global $db;

    // ambil data yang dikirim dari form tambah data kamar

    $nama_kamar = $data['nama'];
    $kapasitas_kamar = $data['kapasitas'];
    $ukuran_kamar = $data['ukuran'];
    $harga_kamar = $data['harga'];
    $status_kamar = $data['status'];

    $foto_kamar = uploadFoto();
    if (!$foto_kamar) {
        return false;
    }

    // tambahkan ke tabel_kamar
    mysqli_query($db, "INSERT INTO tabel_kamar VALUES ('', '$nama_kamar', '$ukuran_kamar', '$kapasitas_kamar', '$harga_kamar', '$status_kamar', '$foto_kamar')");

    return mysqli_affected_rows($db);
}
// edit data kamar
function editDataKamar($data)
{

    global $db;

    // ambil data yang dikirim dari form tambah data kamar

    $nama_kamar = $data['nama'];
    $ukuran_kamar = $data['ukuran'];
    $kapasitas_kamar = $data['kapasitas'];
    $harga_kamar = $data['harga'];
    $status_kamar = $data['status'];
    $foto_lama = $data['foto_lama'];
    $id_kamar = $data['id_kamar'];

    if ($_FILES['foto']['error'] == 4) {

        $foto_kamar = $foto_lama;
    } else {

        $foto_kamar = uploadEdit();
    }

    // tambahkan ke tabel_kamar
    mysqli_query($db, "UPDATE tabel_kamar SET
                                            nama_kamar = '$nama_kamar',
                                            ukuran_kamar = '$ukuran_kamar',
                                            kapasitas = '$kapasitas_kamar',
                                            harga_per_bulan = '$harga_kamar',
                                            status  = '$status_kamar',
                                            foto_kamar = '$foto_kamar' WHERE id_kamar = $id_kamar ");

    return mysqli_affected_rows($db);
}
// fungsi upload foto kamar (tambah data)
function uploadFoto()
{
    // Properti files
    $nama = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $folder = $_FILES['foto']['tmp_name'];

    // Cek jika tidak ada gambar yang diupload
    if ($error == 4) {
        echo "<script>
                alert('Silahkan Upload Foto Kamar !')
              </script>";
        return false;
    }

    // Cek ekstensi gambar yang diupload
    $ekstensiSistem = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiSistem)) {
        echo "<script>
                alert('Ekstensi Gambar yang disarankan (JPG, JPEG, PNG)')
              </script>";
        return false;
    }

    // Cek ukuran gambar yang diupload
    if ($ukuran > 5000000) { // 5MB
        echo "<script>
                alert('Ukuran Gambar terlalu besar - Max: (5MB)')
              </script>";
        return false;
    }

    // Berikan nama file yang unik
    $namaBaru = uniqid() . '.' . $ekstensiGambar;

    // Simpan gambar ke folder tujuan
    if (move_uploaded_file($folder, 'img/foto-kamar/' . $namaBaru)) {
        return $namaBaru;
    } else {
        echo "<script>
                alert('Gagal mengupload gambar')
              </script>";
        return false;
    }
}
function uploadEdit()
{
    // Properti files
    $nama = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $folder = $_FILES['foto']['tmp_name'];

    // Cek jika tidak ada gambar yang diupload
    // if ($error == 4) {
    //     echo "<script>
    //             alert('Silahkan Upload Foto Kamar !')
    //           </script>";
    //     return false;
    // }

    // Cek ekstensi gambar yang diupload
    $ekstensiSistem = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiSistem)) {
        echo "<script>
                alert('Ekstensi Gambar yang disarankan (JPG, JPEG, PNG)')
              </script>";
        return false;
    }

    // Cek ukuran gambar yang diupload
    if ($ukuran > 5000000) { // 5MB
        echo "<script>
                alert('Ukuran Gambar terlalu besar - Max: (5MB)')
              </script>";
        return false;
    }

    // Berikan nama file yang unik
    $namaBaru = uniqid() . '.' . $ekstensiGambar;

    // Simpan gambar ke folder tujuan
    if (move_uploaded_file($folder, 'img/foto-kamar/' . $namaBaru)) {
        return $namaBaru;
    } else {
        echo "<script>
                alert('Gagal mengupload gambar')
              </script>";
        return false;
    }
}
// fungsi hapus data
function hapusKamar($id_kamar)
{
    global $db;

    // Ambil data kamar berdasarkan ID untuk mendapatkan nama gambar
    $result = mysqli_query($db, "SELECT foto_kamar FROM tabel_kamar WHERE id_kamar = $id_kamar");
    $data_kamar = mysqli_fetch_assoc($result);

    // Cek apakah data kamar ditemukan
    if ($data_kamar) {
        // Ambil nama file gambar
        $nama_gambar = $data_kamar['foto_kamar'];
        $path_gambar = 'img/foto-kamar/' . $nama_gambar;

        // Cek apakah file gambar ada di folder
        if (file_exists($path_gambar)) {
            // Hapus file gambar dari folder
            unlink($path_gambar);
        }

        // Hapus data kamar dari database
        mysqli_query($db, "DELETE FROM tabel_kamar WHERE id_kamar = $id_kamar");

        // Cek apakah ada data yang dihapus
        return mysqli_affected_rows($db);
    } else {
        return 0; // Jika tidak ada data yang ditemukan
    }
}

// fungsi menampilkan semua data
function semuaData($query)
{

    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }

    return $rows;
}

// DATA FASILITAS

// tambah data penghuni
function tambahDataPenghuni($data)
{

    global $db;

    // ambil data yang dikirim dari form tambah data kamar

    $nama_penghuni = $data['nama'];
    $alamat = $data['alamat'];
    $tlp = $data['tlp'];
    $tgl_masuk = $data['tgl_masuk'];
    $id_kamar = $data['id_kamar'];


    // tambahkan ke tabel_kamar
    mysqli_query($db, "INSERT INTO tabel_penghuni VALUES ('', '$nama_penghuni', '$alamat', '$tlp', '$tgl_masuk', '$id_kamar')");

    return mysqli_affected_rows($db);
}

// fungsi ubah data penghuni
function editPenghuni($data)
{
    global $db;

    // ambil data yang dikirim dari form tambah data kamar
    $nama_penghuni = $data['nama'];
    $alamat = $data['alamat'];
    $tlp = $data['tlp'];
    $tgl_masuk = $data['tgl_masuk'];
    $id_kamar = $data['id_kamar'];
    $id_penghuni = $data['id_penghuni'];


    // query edit/update data  tabel_penghuni

    mysqli_query($db,  "UPDATE tabel_penghuni SET 
                                              nama_penghuni = '$nama_penghuni',
                                              alamat = '$alamat',
                                              no_tlp = '$tlp',
                                              tgl_registrasi = '$tgl_masuk',
                                              id_kamar = '$id_kamar'  WHERE id_penghuni = $id_penghuni ");

    return mysqli_affected_rows($db);
}



// hapus penghuni
function hapusPenghuni($id_penghuni)
{

    global $db;

    // query hapus data penghuni
    mysqli_query($db,  "DELETE FROM tabel_penghuni WHERE id_penghuni = $id_penghuni ");

    return mysqli_affected_rows($db);
}
// ==============================================






// KELOLA DATA FASILITA
// tambah data Fasilitas
function tambahDataFasilitas($data)
{

    global $db;

    // ambil data yang dikirim dari form tambah data kamar

    $nama_fasilitas = $data['nama'];
    $deskrispi = $data['deskripsi'];

    $foto_fasilitas = uploadFotoFasilitas();
    if (!$foto_fasilitas) {
        return false;
    }

    // tambahkan ke tabel_kamar
    mysqli_query($db, "INSERT INTO tabel_fasilitas VALUES ('', '$nama_fasilitas', '$foto_fasilitas', '$deskrispi')");

    return mysqli_affected_rows($db);
}

// fungsi upload foto kamar (tambah data)
function uploadFotoFasilitas()
{
    // Properti files
    $nama = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $folder = $_FILES['gambar']['tmp_name'];

    // Cek jika tidak ada gambar yang diupload
    if ($error == 4) {
        echo "<script>
                alert('Silahkan Upload Foto Kamar !')
              </script>";
        return false;
    }

    // Cek ekstensi gambar yang diupload
    $ekstensiSistem = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiSistem)) {
        echo "<script>
                alert('Ekstensi Gambar yang disarankan (JPG, JPEG, PNG)')
              </script>";
        return false;
    }

    // Cek ukuran gambar yang diupload
    if ($ukuran > 5000000) { // 5MB
        echo "<script>
                alert('Ukuran Gambar terlalu besar - Max: (5MB)')
              </script>";
        return false;
    }

    // Berikan nama file yang unik
    $namaBaru = uniqid() . '.' . $ekstensiGambar;

    // Simpan gambar ke folder tujuan
    if (move_uploaded_file($folder, 'img/foto-kamar/' . $namaBaru)) {
        return $namaBaru;
    } else {
        echo "<script>
                alert('Gagal mengupload gambar')
              </script>";
        return false;
    }
}
// fungsi edit data fasilitas
function editDataFasilitas($data)
{
    global $db;

    // ambil data yang dikirim dari form tambah data kamar

    $nama_fasilitas = $data['nama'];
    $deskrispi = $data['deskripsi'];
    $gambar_lama = $data['gambar_lama'];
    $id_fasilitas = $data['id_fasilitas'];

    if ($_FILES['gambar']['error'] == 4) {
        $gambar_fasilitas = $gambar_lama;
    } else {

        $gambar_fasilitas = uploadEditFasilitas();
    }

    // tambahkan ke tabel_kamar
    mysqli_query($db, "UPDATE tabel_fasilitas SET
                                          nama_fasilitas = '$nama_fasilitas',
                                           gambar_fasilitas = '$gambar_fasilitas',
                                           deskripsi = '$deskrispi'  
                                           WHERE id_fasilitas = $id_fasilitas ");

    return mysqli_affected_rows($db);
}
//fungsi upload gambar edit data fasilitas
function uploadEditFasilitas()
{
    // Properti files
    $nama = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $folder = $_FILES['gambar']['tmp_name'];


    // Cek ekstensi gambar yang diupload
    $ekstensiSistem = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $nama);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiSistem)) {
        echo "<script>
                alert('Ekstensi Gambar yang disarankan (JPG, JPEG, PNG)')
              </script>";
        return false;
    }

    // Cek ukuran gambar yang diupload
    if ($ukuran > 5000000) { // 5MB
        echo "<script>
                alert('Ukuran Gambar terlalu besar - Max: (5MB)')
              </script>";
        return false;
    }

    // Berikan nama file yang unik
    $namaBaru = uniqid() . '.' . $ekstensiGambar;

    // Simpan gambar ke folder tujuan
    if (move_uploaded_file($folder, 'img/foto-kamar/' . $namaBaru)) {
        return $namaBaru;
    } else {
        echo "<script>
                alert('Gagal mengupload gambar')
              </script>";
        return false;
    }
}
// fungsi hapus data fasilitas
function hapusFasilitas($id_fasilitas)
{
    global $db;

    // Ambil data kamar berdasarkan ID untuk mendapatkan nama gambar
    $result = mysqli_query($db, "SELECT gambar_fasilitas FROM tabel_fasilitas WHERE id_fasilitas = $id_fasilitas");
    $data_kamar = mysqli_fetch_assoc($result);

    // Cek apakah data kamar ditemukan
    if ($data_kamar) {
        // Ambil nama file gambar
        $nama_gambar = $data_kamar['gambar_fasilitas'];
        $path_gambar = 'img/foto-kamar/' . $nama_gambar;

        // Cek apakah file gambar ada di folder
        if (file_exists($path_gambar)) {
            // Hapus file gambar dari folder
            unlink($path_gambar);
        }

        // Hapus data kamar dari database
        mysqli_query($db, "DELETE FROM tabel_fasilitas WHERE id_fasilitas = $id_fasilitas");

        // Cek apakah ada data yang dihapus
        return mysqli_affected_rows($db);
    } else {
        return 0; // Jika tidak ada data yang ditemukan
    }
}


// KELOLA DATA TAGIHAN

// tambah data tagihan
function tambahTagihan($data)
{

    global $db;

    // ambil data yang dikirim dari form tambah data tagihan

    $id_penghuni = $data['id_penghuni'];
    $jumlah_tagihan = $data['jumlah_tagihan'];
    $tgl_pembayaran = $data['tgl_pembayaran'];
    $tgl_dibayar = $data['tgl_dibayar'];
    $status = $data['status'];

    // insert / tambahkan ke tabel tagihan
    mysqli_query($db, "INSERT INTO tagihan_kos VALUES('', '$id_penghuni', '$jumlah_tagihan', '$tgl_pembayaran', '$status', '$tgl_dibayar')");

    return mysqli_affected_rows($db);
}
// Konfirmasi Tagihan
function ubahTagihan($data)
{

    global $db;

    // ambil data yang dikirim 
    $id_tagihan = $data['id_tagihan'];
    $status = $data['status'];
    $tgl_dibayar = $data['tgl_dibayar'];

    // update status pembayaran
    mysqli_query($db, "UPDATE tagihan_kos SET status_pembayaran = '$status',
                                               tanggal_dibayar = '$tgl_dibayar' 
                                               WHERE id_tagihan = $id_tagihan");

    return mysqli_affected_rows($db);
}
// Hapus data Tagihan
function hapusTagihan($id_tagihan)
{
    global $db;

    // query hapus data tagihan berdasrakan ID_tagihan
    mysqli_query($db, "DELETE FROM tagihan_kos WHERE id_tagihan = $id_tagihan ");

    return mysqli_affected_rows($db);
}


// HITUNG DATA

function jumlahHunian()
{

    global $db;

    $result =  mysqli_query($db, "SELECT * FROM tabel_penghuni");

    return $result->num_rows;
}
// total semua kamar
function jumlahKamar()
{

    global $db;

    $result =  mysqli_query($db, "SELECT * FROM tabel_kamar");

    return $result->num_rows;
}
// total kamar yang tersedia
function jumlahKamarTersedia()
{

    global $db;

    $result =  mysqli_query($db, "SELECT * FROM tabel_kamar WHERE status = 'Tersedia'");

    return $result->num_rows;
}
// total kamar yang Sudah Terisi
function jumlahKamarTerisi()
{

    global $db;

    $result =  mysqli_query($db, "SELECT * FROM tabel_kamar WHERE status = 'Sudah Terisi'");

    return $result->num_rows;
}
// total semua fasilitas
function jumlahFasilitas()
{

    global $db;

    $result =  mysqli_query($db, "SELECT * FROM tabel_fasilitas");

    return $result->num_rows;
}

// total yang belaum lunas
function belumLunas()
{

    global $db;

    $belum_lunas = mysqli_query($db, "SELECT * FROM tagihan_kos WHERE status_pembayaran = 'Belum Dibayar'");

    return $belum_lunas->num_rows;
}
