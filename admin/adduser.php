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

  $uname = input($_POST["username"]);
  $pass = input($_POST["password"]);

  $sql = "insert into user_info (uname,pass,level)
          values('$uname','$pass','user')";


  $hasil = mysqli_query($conn, $sql);

  //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
  if ($hasil) {
    header("Location:./manageusers.php");
  } else {
    echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
  }
}
