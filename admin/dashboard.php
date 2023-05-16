<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Hardware Inventory</title>
</head>

<body>
    <!-- Delete Table -->
    <?php
    include "../connect.php";
    if (isset($_GET['table'])) {
        $table = htmlspecialchars($_GET["table"]);

        $sql = "drop table $table ";
        $hasil = mysqli_query($conn, $sql);

        //Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location:./dashboard.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
    ?>
    <!-- Delete Table -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1"><a class="home" href="./dashboard.php">HARDWARE INVENTORY</a></span>
        <div class="d-flex justify-content-start collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav align-items-center" id="navbarSupportedContent">
                <a class="nav-link active" aria-current="page" href="./das.php">DASHBOARD</a>
                <!-- Dropdown -->
                <div class="dropdown">
                    <a class="dropdown-toggle fw-normal nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CATEGORY
                    </a>

                    <ul class="dropdown-menu p-1">
                        <?php
                        include "../connect.php";
                        $sql = "show tables";
                        $hasil = mysqli_query($conn, $sql);
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)) {
                            $no++;
                        ?>
                            <li class="m-2"><a class="content" href="./show.php?table=<?php echo htmlspecialchars($data[0]); ?>&sort=no_aset"><span class="text-uppercase fw-bold"><?php echo htmlspecialchars($data[0]); ?></span></a></li>
                        <?php
                        }
                        ?>
                        <a href="#" class="btn btn-primary text-nowrap" role="button" data-bs-toggle="modal" data-bs-target="#addCatModal">Tambah Category</a>
                    </ul>
                </div>
                <!-- Dropdown -->
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <h4 class="fw-bold">
            <center>DASHBOARD</center>
        </h4>

        <tr class="table-danger">
            <table class="my-3 table table-borderless">
                <thead>
                    <tr class="table-primary">
                        <th class="fw-bold">Category</th>
                        <th class="fw-bold">Jumlah Data</th>
                        <th class="fw-bold">Baru</th>
                        <th class="fw-bold">Lama</th>
                        <th class="fw-bold">Rusak</th>
                        <th class="fw-bold">Keluar</th>
                </thead>

                <?php
                include "../connect.php";
                $sql = "CALL database_tables_row_count('$db')";
                $hasil = mysqli_query($conn, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>

                    <tbody>
                        <tr>
                            <td class="text-capitalize fw-medium"><a class="content" href="./show.php?table=<?php echo htmlspecialchars($data["table"]); ?>&sort=no_aset"><span class="text-capitalize fw-semibold"><?php echo htmlspecialchars($data[0]); ?></span></a></td>
                            <td class="fw-medium"><?php echo $data["row_count"]; ?></td>
                            <td class="fw-medium"><?php echo $data["baru"]; ?></td>
                            <td class="fw-medium"><?php echo $data["lama"]; ?></td>
                            <td class="fw-medium"><?php echo $data["rusak"]; ?></td>
                            <td class="fw-medium"><?php echo $data["keluar"]; ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>

            <!-- Add Modal -->
            <form action="./addcat.php" method="post">
                <div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Category:</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Category" required />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary submit">Submit</button>
                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Add Modal -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>