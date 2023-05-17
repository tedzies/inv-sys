<?php
session_start();

include 'connect.php';

$uname = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from user_info where uname='$uname' and pass='$pass'";

$login = mysqli_query($conn, $sql);

$cek = mysqli_num_rows($login);

if ($cek > 0) {

  $data = mysqli_fetch_assoc($login);

  // cek jika user login sebagai admin
  if ($data['level'] == "admin") {

    // buat session login dan username
    $_SESSION['username'] = $uname;
    $_SESSION['level'] = "admin";
    // alihkan ke halaman dashboard admin
    header("location:admin/dashboard.php");

    // cek jika user login sebagai pegawai
  } else if ($data['level'] == "user") {
    // buat session login dan username
    $_SESSION['username'] = $uname;
    $_SESSION['level'] = "user";
    // alihkan ke halaman dashboard pegawai
    header("location:user/dashboard.php");
  } else {

    // alihkan ke halaman login kembali
    header("location:index.php?pesan=gagal");
  }
} else {
  header("location:index.php?pesan=gagal");
}
