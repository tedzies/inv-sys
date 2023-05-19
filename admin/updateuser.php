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
  $uname = input($_POST["username"]);
  $pass = input($_POST["password"]);

  $sql = "update user_info set
    uname='$uname',
    pass='$pass'
    where id= $id";

  $hasil = mysqli_query($conn, $sql);

  if ($hasil) {
    header("Location:./manageusers.php");
  } else {
    echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
  }
}
