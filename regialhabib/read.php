<?php

session_start();



if (!isset($_SESSION["login"])) {
    echo "<script> 
        document.location.href = 'login.php';
    </script>";
}

// mengambil data dari halaman function.php
require "KonekDatabase/function.php";

// memanggil function query dengan parameter tabel yang akan di query
// dan menyimpan function tersebut ke dalam variabel $mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Daftar Mahasiswa</title>


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
                    <li class="nav-item ">
                        <a href="logout.php"><button type="button" class="btn btn-outline-light">Log Out</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <a href="create.php"><button class="btn btn-primary mt-4 mb-4" type="submit">Create</button></a>
        <form action="" method="POST">
            <div class="row">
                <div class="col-4 d-flex">
                    <input type="search" name="keyword" class="form-control me-2" placeholder="Input Keyword"><button type="submit" name="cari" class="btn btn-outline-primary"> Cari</button>
                </div>
            </div>


        </form>

        <div class="table-responsive">

            <table class="table table-striped table-hover">


                <tr>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>JURUSAN</th>
                    <th>FAKULTAS</th>
                    <th>GAMBAR</th>
                    <th>AKSI</th>
                </tr>
                <?php foreach ($mahasiswa as $mhs) : ?>
                    <tr>
                        <td><?php echo $mhs["nim"] ?></td>
                        <td><?php echo $mhs["nama"] ?></td>
                        <td><?php echo $mhs["email"] ?></td>
                        <td><?php echo $mhs["jurusan"] ?></td>
                        <td><?php echo $mhs["fakultas"] ?></td>
                        <td><img src="img/<?php echo $mhs["gambar"] ?>" alt="" height="50"></td>
                        <td>
                            <a href="update.php?nim=<?php echo $mhs["nim"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a> |
                            <a href="delete.php?nim=<?php echo $mhs["nim"] ?>" onclick="return confirm('Apakah Anda Ingin Menghapus Data')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg></a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>