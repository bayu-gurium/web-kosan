<?php

require 'database.php';
require 'kelola-data.php';

// ambil id
$id_penghuni = $_GET['id'];

if (hapusPenghuni($id_penghuni) > 0) {

    header('location: penghuni.php');
}
