<?php

require 'database.php';
require 'kelola-data.php';

// ambil id
$id_fasilitas = $_GET['id'];

if (hapusFasilitas($id_fasilitas) > 0) {

    header('location: fasilitas.php');
}
