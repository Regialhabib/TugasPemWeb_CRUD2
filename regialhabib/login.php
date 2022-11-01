<?php
session_start();
if (isset($_COOKIE["login"])) {
    $_SESSION["login"] = true;
}

if (isset($_SESSION["login"])) {
    header("Location:home.php");
}

require 'KonekDatabase/function.php';

$koneksi;

if (isset($_POST["submit"])) {
    if (login($_POST) === true) {

        echo "<script> 
                alert('login berhasil');
                document.location.href = 'home.php';
             </script>";
    } else {
        echo "<script> 
                alert('login gagal');
             </script>";
    }
}

?>





<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <div class="col-4 mx-auto p-3 shadow">
            <h2 class="text-center">LOGIN</h2>
            <form action="" method="POST">
                <label for="username" class="form-label">username</label>
                <input type="text" id="username" name="username" class="form-control">
                <label for="password" class="form-label">password</label>
                <input type="password" id="password" name="password" class="form-control">
                <input type="checkbox" name="check" id="checkbox" class="form-check-input">
                <label for="checkbox" class="form-check-label">remember me</label><br><br>
                <p>Belum punya akun? <span><a href="register.php">buat akun</a></span></p>
                <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>

            </form>
        </div>

    </div>

</body>

</html>