<?php
include "../connect.php";
function input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = htmlspecialchars($_POST["id"]);
  $table = htmlspecialchars($_POST["table"]);
  $noaset = strtoupper(input($_POST["no_aset"]));
  $merek = strtoupper(input($_POST["merek"]));
  $sernum = strtoupper(input($_POST["ser_num"]));
  $masuk = date('Y-m-d', strtotime($_POST['tgl_masuk']));
  $keluar = date('Y-m-d', strtotime($_POST['tgl_keluar']));
  $status = strtoupper(input($_POST['status']));

  if ($keluar == "1970-01-01") {
    $sql = "update $table set
    no_aset='$noaset',
    merek='$merek',
    ser_num='$sernum',
    status='$status',
    tgl_masuk='$masuk',
    tgl_keluar= null
    where id= $id";
  } else {
    $sql = "update $table set
    no_aset='$noaset',
    merek='$merek',
    ser_num='$sernum',
    status='$status',
    tgl_masuk='$masuk',
    tgl_keluar='$keluar'
    where id= $id";
  }

  $hasil = mysqli_query($conn, $sql);

  if ($hasil) {
    header("Location:./show.php?table=$table&sort=no_aset");
  } else {
    echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
  }
}
