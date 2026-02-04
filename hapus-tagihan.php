<?php

require 'database.php';
require 'kelola-data.php';

// ambil id_tagihan
$id_tagihan = $_GET['id'];

if (hapusTagihan($id_tagihan) > 0) {

    header('location: tagihan.php');
}
