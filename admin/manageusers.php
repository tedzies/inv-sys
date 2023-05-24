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
  <?php
  include "../connect.php";
  session_start();

  if ($_SESSION['level'] != "admin") {
    header("location:../index.php");
  }
  ?>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <span class="navbar-brand mb-0 h1"><a class="home" href="./dashboard.php">HARDWARE INVENTORY</a></span>
    <div class="d-flex justify-content-between collapse navbar-collapse" id="navbarSupportedContent">
      <div class="navbar-nav align-items-center" id="navbarSupportedContent">
        <a class="nav-link active" aria-current="page" href="./dashboard.php">BERANDA</a>
        <!-- Dropdown -->
        <div class="dropdown">
          <a class="dropdown-toggle fw-normal nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            KATEGORI
          </a>

          <ul class="dropdown-menu p-1">
            <?php
            include "../connect.php";
            $sql = "show tables where tables_in_$db <> 'user_info';";
            $hasil = mysqli_query($conn, $sql);
            $no = 0;
            while ($data = mysqli_fetch_array($hasil)) {
              $no++;
            ?>
              <li class="m-2"><a class="content" href="./show.php?table=<?php echo htmlspecialchars($data[0]); ?>&sort=no_aset"><span class="text-uppercase fw-bold"><?php echo htmlspecialchars($data[0]); ?></span></a></li>
            <?php
            }
            ?>
            <a href="#" class="btn btn-primary text-nowrap" role="button" data-bs-toggle="modal" data-bs-target="#addCatModal">Tambah Kategori</a>
          </ul>
        </div>
        <!-- Dropdown -->
      </div>
      <div class="d-flex align-items-center">
        <div class="btn-group-sm dropstart me-2">
          <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Pengaturan
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item my-1" href="#" role="button" data-bs-toggle="modal" data-bs-target="#editLoginModal">Atur Login</a></li>
            <li><a class="dropdown-item my-1" href="manageusers.php">Atur Pengguna</a></li>
            <li><a class="dropdown-item mt-3" href="../logout.php">Keluar</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Delete Data -->
  <?php
  include "../connect.php";
  if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "delete from user_info where id='$id' ";
    $hasil = mysqli_query($conn, $sql);
    if ($hasil) {
      header("Location:./manageusers.php");
    } else {
      echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
    }
  }
  ?>
  <!-- Delete Data -->

  <div class="container">
    <br>
    <h4 style="text-transform:uppercase">
      <center>Atur Pengguna</center>
    </h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./dashboard.php">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Atur Pengguna</li>
      </ol>
    </nav>

    <div class="d-flex justify-content-between">
      <div class="d-flex flex-columns buttons">
        <a href="#" class="btn btn-primary me-1" role="button" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Pengguna</a>
      </div>
    </div>

    <tr class="table-danger">
      <thead>
        <table class="my-3 table table-bordered">
          <tr class="table-primary">
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th colspan='2'>Aksi</th>
      </thead>

      <?php
      $sql = "select *
        from user_info where level != 'admin' order by id";
      $hasil = mysqli_query($conn, $sql);
      $no = 0;
      while ($data = mysqli_fetch_array($hasil)) {
        $no++;
      ?>

        <tbody>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["uname"]; ?></td>
            <td><?php echo $data["pass"]; ?></td>
            <td>
              <a href="#" class="btn btn-warning m-1 in-table" role="button" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $data['id']; ?>">Ubah</a>
              <a href="#" class="btn btn-danger m-1 in-table" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $data['id']; ?>">Hapus</a>
            </td>
          </tr>

          <!-- Update Form Modal -->
          <form action="./updateuser.php" method="post">
            <div class="modal fade" id="updateModal<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label>Username:</label>
                      <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="<?php echo $data["uname"]; ?>" required />
                    </div>
                    <div class="form-group">
                      <label>Password:</label>
                      <input type="text" name="password" class="form-control" placeholder="Masukkan Password" value="<?php echo $data["pass"]; ?>" required />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary submit">Simpan</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- Update Form Modal -->

          <!-- Delete Modal -->
          <div class="modal fade" id="deleteModal<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengguna</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Hapus <?php echo $data['uname']; ?>?</p>
                </div>
                <div class="modal-footer">
                  <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $data['id']; ?>" class="btn btn-danger in-table" role="button">Hapus</a>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Delete Modal -->


        </tbody>
      <?php
      }
      ?>
      </table>

      <!-- Add data Form Modal -->
      <form action="./adduser.php" method="post">
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label>Username:</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required />
                </div>
                <div class="form-group">
                  <label>Password:</label>
                  <input type="text" name="password" class="form-control" placeholder="Masukan Password" required />
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary submit">Simpan</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Add data Form Modal -->
      <!-- Add Modal -->
      <form action="./addcat.php" method="post">
        <div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama Kategori:</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Kategori" required />
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary submit">Tambah</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Add Modal -->
      <!-- Edit login -->
      <form action="./editlogin.php" method="post">
        <div class="modal fade" id="editLoginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Atur Info Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Username Lama:</label>
                  <input type="text" name="oldusername" class="form-control" placeholder="Masukan username lama" required />
                </div>
                <div class="form-group">
                  <label>Password Lama:</label>
                  <input type="password" name="oldpassword" class="form-control" placeholder="Masukan password lama" required />
                </div>
                <div class="form-group">
                  <label>Username Baru:</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan username baru" required />
                </div>
                <div class="form-group">
                  <label>Password Baru:</label>
                  <input type="password" name="password" class="form-control" placeholder="Masukan password baru" required />
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary submit">Simpan</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Batal</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- Edit Login -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>