<?php

require 'database.php';
require 'kelola-data.php';

// ambil id
$id_kamar = $_GET['id'];

if (hapusKamar($id_kamar) > 0) {

    header('location: kamar.php');
}
