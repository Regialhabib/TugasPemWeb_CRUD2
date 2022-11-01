<?php

session_start();
require "KonekDatabase/function.php";


if (!isset($_SESSION["login"])) {
    echo "<script> 
        document.location.href = 'login.php';
    </script>";
}


if (hapus($_GET["nim"]) > 0) {
    echo "<script> 
                alert('Data Berhasil Di Hapus');
                document.location.href = 'read.php';
              </script>";
} else {
    echo "<script> 
                alert('Data Gagal Di Hapus');
                document.location.href = 'read.php';
              </script>";
}
