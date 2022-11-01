<?php

// konek ke database
$koneksi = mysqli_connect("localhost", "root", "", "mahasiswa");

// membuat function query  untuk mengquery data dari tabel mahasiswa
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);

    // deklarasi variabel array untuk menampung/menyimpan data dar tabel mahasiswa
    $save = [];

    // membuat perulangan dengan funtion mysqli_fetch_assoc dan meyimpannya dalam variable array $save
    while ($keep = mysqli_fetch_assoc($result)) {
        $save[] = $keep;
    }
    return $save;
};


function tambah($data)
{
    global $koneksi;

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fakultas = htmlspecialchars($data["fakultas"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }


    // menyimpan syntax query insert dalam variabel
    $insert = "INSERT INTO mahasiswa VALUES (
    '$nim','$nama','$email','$jurusan','$fakultas','$gambar'
)";

    // melakukan query untuk insert/tambah data kedalam database
    mysqli_query($koneksi, $insert);

    return mysqli_affected_rows($koneksi);
};

function hapus($nim)
{
    global $koneksi;



    $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim ='$nim'");
    $row = mysqli_fetch_assoc($result);



    $gambar = $row["gambar"];


    if (file_exists("img/$gambar")) {

        unlink("img/$gambar");
    }
    $hapus = "DELETE FROM mahasiswa WHERE nim = $nim";

    mysqli_query($koneksi, $hapus);

    return mysqli_affected_rows($koneksi);
}

function update($data)
{
    global $koneksi;

    if (isset($data["submit"])) {
        $nim = htmlspecialchars($data["nim"]);
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $fakultas = htmlspecialchars($data["fakultas"]);
        $gambarLama = htmlspecialchars($data["gambarLama"]);
    };


    if ($_FILES["gambar"]["error"] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        // menghapus gambar lama
        
        unlink("img/$gambarLama");
        
        
    }

    // menyimpan syntax query update dalam variabel
    $update = "UPDATE mahasiswa SET 
            nim = '$nim',
            nama = '$nama',
            email = '$email',
            jurusan = '$jurusan',
            fakultas = '$fakultas',
            gambar = '$gambar'
            WHERE nim = '$nim'
            ";

    // melakukan query untuk update/tambah data kedalam database
    mysqli_query($koneksi, $update);

    return mysqli_affected_rows($koneksi);
};

function upload()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tempatFile = $_FILES["gambar"]["tmp_name"];


    // validasi pakah user menginput gambar
    if ($error == 4) {
        echo "<script> 
                alert('Tambahkan Gambar Terlebih Dahulu');
              </script>";

        return false;
    }


    // validasi apakah file yang di upload adalah gambar
    $ekstensiGambarValid = ["jpg", "png", "jpeg"];

    // fungsi explode memecah srting menjadi array
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script> 
                alert('Kamu Tidak Memasukan Gambar');
              </script>";
        return false;
    }

    // validasi ukuran gambar max 5mb

    if ($ukuranFile > 5000000) {
        echo "<script> 
                alert('Ukuran Gambar Terlalu Besar');
              </script>";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tempatFile, "img/" . $namaFileBaru);
    return $namaFileBaru;
}

function register($data)
{
    global $koneksi;
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $password2 = $data["password-2"];

    if ($password !== $password2) {
        echo "<script> 
                alert('Password Tidak Sama');
              </script>";
        return false;
    }
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {

        echo "<script> 
                alert('Username sudah Terdaftar');
              </script>";
        return false;
    }
    $password = password_hash($password,PASSWORD_DEFAULT);
    $insertDB = "INSERT INTO users  VALUES ('$username','$email','$password')";
    mysqli_query($koneksi, $insertDB);

    return mysqli_affected_rows($koneksi);
}

function login($data)
{
    
    global $koneksi;
    $username = $data["username"];
    $password = $data["password"];

    $queryDB = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $queryDB);


    if (!$var = mysqli_fetch_assoc($result)) {
        echo "<script> 
                alert('username tidak terdaftar');
               </script>";
        return false;
    }
    if (!password_verify($password,$var["password"])) {
        echo "<script> 
                alert('username atau password salah');
              </script>";
        return false;
    }
    
    $_SESSION["login"] = true;
    
    if (isset($data["check"])) {
        setcookie("login","true",mktime(24));
    }

    return true;
}

function cari($keyword) {

    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR fakultas LIKE '%$keyword%'";

    return query($query);

}