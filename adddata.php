<?php
include "connect.php";

function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $noaset = strtoupper(input($_POST["no_aset"]));
    $merek = strtoupper(input($_POST["merek"]));
    $sernum = strtoupper(input($_POST["ser_num"]));
    $status = strtoupper(input($_POST["status"]));
    $masuk = date('Y-m-d', strtotime($_POST['tgl_masuk']));
    $keluar = date('Y-m-d', strtotime($_POST['tgl_keluar']));
    $table = htmlspecialchars($_POST["table"]);

    if ($keluar == "1970-01-01") {
        $keluar = null;
    }

    $sql = "insert into $table (no_aset,merek,ser_num,status,tgl_masuk,tgl_keluar)
    values
    ('$noaset','$merek','$sernum','$status','$masuk','$keluar')";

    $hasil = mysqli_query($conn, $sql);

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hasil) {
        header("Location:show.php?table=$table&sort=no_aset");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}
