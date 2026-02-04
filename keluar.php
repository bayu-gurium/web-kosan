<?php
// jalankan session
session_start();

require 'database.php';


// bersihkan session
session_destroy();

header('location: login.php');
