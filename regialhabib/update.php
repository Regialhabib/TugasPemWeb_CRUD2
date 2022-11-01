<?php

session_start();



if (!isset($_SESSION["login"])) {
    echo "<script> 
        document.location.href = 'login.php';
    </script>";
}

require "KonekDatabase/function.php";

$nim = $_GET["nim"];

$mahasiswa = query("SELECT * FROM mahasiswa WHERE nim=$nim");

foreach ($mahasiswa as $mhs) {
} 

if (isset($_POST["submit"])) {

    if (update($_POST) > 0) {
        echo "<script> 
                alert('Berhasil Mengubah Data');
                document.location.href = 'read.php';
              </script>";
    } else {
        echo "<script> alert('Gagal Mengubah Data') </script>";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tambah Data</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary ">
        <div class="container">
            <a class="navbar-brand text-white" href="home.php">REGI AL HABIB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="read.php">Table</a>
                    </li>
                    <li class="nav-item mx-3">
                        <button type="button" class="btn btn-outline-light">Log In</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-5">
            <div class="col offset-1">
                <h2>UPDATE DATA</h2>
            </div>
        </div>


        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]  ?>">
            <div class="row">
                <div class="col-5 offset-1">
                    <label for="nim" class="form-label">Nim</label>
                    <input type="text" name="nim" id="nim" value="<?php echo $mhs["nim"] ?>" class="form-control mb-3">
                </div>
                <div class="col-5">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" value="<?php echo $mhs["nama"] ?>" class="form-control mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col-5 offset-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $mhs["email"] ?>" class="form-control mb-3">
                </div>
                <div class="col-5">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" value="<?php echo $mhs["jurusan"] ?>" class="form-control mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col-5 offset-1">
                    <label for="fakultas" class="form-label">fakultas</label>
                    <input type="text" name="fakultas" id="fakultas" value="<?php echo $mhs["fakultas"] ?>" class="form-control mb-3">
                </div>
                <div class="col-5">
                    <label for="gambar" class="form-label">Pilih Untuk Ganti Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control mb-3">
                </div>
            </div>
            <div class="row">
                <div class="col-5 offset-1">
                    <button type="submit" name="submit" class="btn btn-primary">Update Data</button>
                </div>
                <div class="col-5">
                    <label for="Gambar" class="form-label">GAMBAR</label>
                    <img src="img/<?php echo $mhs["gambar"] ?>" alt="" height="100px">
                </div>
            </div>


















        </form>
    </div>
</body>

</html>