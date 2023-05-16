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

    $nama = input($_POST["nama"]);
    $sql = "create table if not exists $nama( 
        id INT NOT null AUTO_INCREMENT, 
        no_aset varchar(20), 
        merek varchar(20), 
        ser_num varchar(20),
        status varchar(8),
        tgl_masuk date,
        tgl_keluar date, 
        PRIMARY key (id) 
        )";

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        header("Location:./dashboard.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}
