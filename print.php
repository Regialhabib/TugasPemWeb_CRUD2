<?php 
require 'KonekDatabase/function.php';
require 'vendor/autoload.php';
$mahasiswa = query("SELECT * FROM mahasiswa");


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$html = '<html>
<head></head>
<body>
<table border="1" cellpadding="10" cellspacing="0">


<tr>
    <th>No</th>
    <th>NIM</th>
    <th>NAMA</th>
    <th>EMAIL</th>
    <th>JURUSAN</th>
    <th>FAKULTAS</th>
    <th>GAMBAR</th>
</tr>';
$no = 1;
foreach ($mahasiswa as $mhs) {
    $html.='<tr> 
    <td>'.$no++.'</td>
    <td>'.$mhs["nim"].'</td>
    <td>'.$mhs["nama"].'</td>
    <td>'.$mhs["email"].'</td>
    <td>'.$mhs["jurusan"].'</td>
    <td>'.$mhs["fakultas"].'</td>
    <td><img src="img/'. $mhs["gambar"].'" height="50"></td>
    </tr>';
}
    
$html.='
</table>
</body>
</html>';
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();




?>