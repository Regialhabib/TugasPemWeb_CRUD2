<?php

session_start();

if (isset($_SESSION["login"])) {
    header("Location:home.php");
}

require 'KonekDatabase/function.php';

if (isset($_POST["submit"])) {
    if (register($_POST) > 0) {
        echo "<script> alert('Registrasi Berhasil');
        document.location.href = 'login.php';
        </script>";
    }
}

?>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>register</title>
</head>

<body>

    <div class="container mt-5">


        <form action="" method="POST">
            <div class="col-4 mx-auto shadow p-3">


                <h2 class="text-center">REGISTRASI</h2>
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" required class="form-control">


                <label for="email" class="form-label"> Email</label>
                <input type="email" name="email" id="email" required class="form-control">


                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" required class="form-control">


                <label for="password-2" class="form-label">Confirm Password</label>
                <input type="password" id="password-2" name="password-2" required class="form-control">

                <p>Sudah punya akun? <span><a href="login.php">Login</a></span></p>

                <button type="submit" name="submit" class="btn btn-primary mt-2">submit</button>




            </div>
        </form>
    </div>








</body>

</html>