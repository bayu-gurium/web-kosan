<?php

// jalankan session
session_start();

require 'database.php';


// cek jika tombol login ditekan
if (isset($_POST['login'])) {

    // ambil username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query cek data ke tabel user
    $query = mysqli_query($db, "SELECT * FROM tabel_user WHERE username = '$username'");
    // cek apakah usernamenya sesuai datau tidak
    if (mysqli_num_rows($query) > 0) {

        // cek ketersediaan data user
        $user = mysqli_fetch_assoc($query);

        // cek apakah passwordnya sesuai atau tidak
        if (password_verify($password, $user['password'])) {

            // set session dan arahkan ke halaman dashbaord jika username dan password benar
            $_SESSION['login'] = true;
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['username'] = $user['username'];
            header('location: dashboard.php');
        } else {
            // jika password tidak sesuai
            $password_eror = true;
        }
    } else {

        // jika username tidak sesuai
        $username_eror = true;
    }
}

?>

<!-- kode warna -->

<!-- text-orange : #f16127 -->
<!-- text-hijau : #18e87b -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kos Batak</title>
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

<body>

    <!-- kontent -->
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh;">
            <div class="row justify-content-center">
                <div class="col-lg-4 py-5">
                    <!-- alert web -->
                    <?php if (isset($username_eror)) : ?>
                        <div class="alert alert-danger border-0">
                            Username tidak ditemukan !
                        </div>
                    <?php endif ?>
                    <?php if (isset($password_eror)) : ?>
                        <div class="alert alert-danger border-0">
                            Password tidak sesuai !
                        </div>
                    <?php endif ?>

                    <a href="index.php" class="text-decoration-none"><i class="bi bi-reply"></i> Beranda</a>
                    <h4 class="mt-2" style="color: #f16127;">Selamat Datang 👋</h4>
                    <small class="">Silahkan Login</small>
                    <form action="" method="post" class="mt-2">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>

                        <div class="form-group">
                            <button class="btn py-2 text-white my-2 w-100" style="background-color:#f16127;" name="login">LOGIN</button>
                        </div>

                    </form>
                </div>
                <div class="col-lg-5 border d-lg-flex d-none rounded bg-light">
                    <div class="img" style="background-image: url(img/heero-1.png); width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                </div>
            </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>

</html>