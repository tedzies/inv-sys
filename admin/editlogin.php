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
  $uname = htmlspecialchars($_POST["username"]);
  $pass = htmlspecialchars($_POST["password"]);
  $olduname = htmlspecialchars($_POST["oldusername"]);
  $oldpass = htmlspecialchars($_POST["oldpassword"]);

  $sql = "update user_info set
    uname='$uname',
    pass='$pass'
    where uname= '$olduname'
    and pass= '$oldpass'";

  $hasil = mysqli_query($conn, $sql);

  if ($hasil) {
    header("Location:./dashboard.php");
  }
}
