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
  session_start();

  if ($_SESSION['level'] != "user") {
    header("location:../index.php");
  }
  include "../connect.php";
  if (isset($_GET['table'])) {
    $table = htmlspecialchars($_GET["table"]);
    if (isset($_GET['sort'])) {
      $sort = htmlspecialchars($_GET["sort"]);
    }
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
            <li><a class="dropdown-item" href="../logout.php">Keluar</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Delete Data -->
  <!-- Delete Data -->

  <div class="container">
    <br>
    <h4 style="text-transform:uppercase">
      <center><?php echo $table ?></center>
    </h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./dashboard.php">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $table; ?></li>
      </ol>
    </nav>

    <div class="d-flex justify-content-between">
      <div class="d-flex flex-columns buttons">
        <a href="#" class="btn btn-primary me-1" role="button" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</a>
        <div class="dropdown">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sortir
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./show.php?table=<?php echo $table ?>&sort=no_aset">No Aset</a></li>
            <li><a class="dropdown-item" href="./show.php?table=<?php echo $table ?>&sort=merek">Merek</a></li>
            <li><a class="dropdown-item" href="./show.php?table=<?php echo $table ?>&sort=status">Status</a></li>
            <li><a class="dropdown-item" href="./show.php?table=<?php echo $table ?>&sort=tgl_masuk">Tanggal Masuk</a></li>
            <li><a class="dropdown-item" href="./show.php?table=<?php echo $table ?>&sort=tgl_keluar">Tanggal Keluar</a></li>
          </ul>
        </div>
      </div>

      <form action="./search.php?table=<?php echo $table ?>" method="post">
        <div class="input-group">
          <input type="text" name="cari" class="form-control" placeholder="Cari No.Aset" aria-label="search bar" aria-describedby="search-button">
          <input type="hidden" name="table" value=<?php echo $table; ?>>
          <button class="btn btn-outline-primary" type="submit" id="search-button">Cari</a>
        </div>
      </form>
    </div>

    <tr class="table-danger">
      <thead>
        <table class="my-3 table table-bordered">
          <tr class="table-primary">
            <th>No</th>
            <th>No Aset</th>
            <th>Merek</th>
            <th>Serial Number</th>
            <th>Status</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th colspan='2'>Aksi</th>
      </thead>

      <?php
      $sql = "select *
        from $table order by $sort";
      $hasil = mysqli_query($conn, $sql);
      $no = 0;
      while ($data = mysqli_fetch_array($hasil)) {
        $no++;
      ?>

        <tbody>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data["no_aset"]; ?></td>
            <td><?php echo $data["merek"]; ?></td>
            <td><?php echo $data["ser_num"]; ?></td>
            <td><?php echo $data["status"]; ?></td>
            <td><?php echo $data["tgl_masuk"]; ?></td>
            <td><?php echo $data["tgl_keluar"]; ?></td>
            <td>
              <a href="#" class="btn btn-warning m-1 in-table" role="button" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $data['id']; ?>">Ubah</a>
            </td>
          </tr>

          <!-- Update Form Modal -->
          <form action="./updatedata.php" method="post">
            <div class="modal fade" id="updateModal<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <div class="form-group">
                      <label>No. Aset:</label>
                      <input type="text" name="no_aset" class="form-control" placeholder="Masukkan No. Aset" value="<?php echo $data["no_aset"]; ?>" required />
                    </div>
                    <div class="form-group">
                      <label>Merek:</label>
                      <input type="text" name="merek" class="form-control" placeholder="Masukan merek" value="<?php echo $data["merek"]; ?>" required />
                    </div>
                    <div class="form-group">
                      <label>S/N :</label>
                      <input type="text" name="ser_num" class="form-control" placeholder="Masukan S/N" value="<?php echo $data["ser_num"]; ?>" required />
                    </div>
                    <div class="form-group">
                      <label class="form-label fw-semibold">Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="baru" value="baru" checked>
                        <label class="form-check-label" for="baru">
                          Baru
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="lama" value="lama">
                        <label class="form-check-label" for="lama">
                          Lama
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="rusak" value="rusak">
                        <label class="form-check-label" for="rusak">
                          Rusak
                        </label>
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col">
                        <label for="tgl_masuk" class="form-label fw-semibold">
                          Tanggal Masuk
                        </label>
                        <input id="tgl_masuk" class="form-control" type="date" name="tgl_masuk" value="<?php echo $data['tgl_masuk']; ?>" />
                      </div>
                      <div class="col">
                        <label for="tgl_keluar" class="form-label fw-semibold">
                          Tanggal Keluar
                        </label>
                        <input id="endDate" class="form-control" type="date" name="tgl_keluar" value="<?php echo $data['tgl_keluar']; ?>" />
                      </div>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                    <input type="hidden" name="table" value="<?php echo $table; ?>" />
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

        </tbody>
      <?php
      }
      ?>
      </table>

      <!-- Add data Form Modal -->
      <form action="./adddata.php" method="post">
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <div class="form-group">
                  <label>No. Aset:</label>
                  <input type="text" name="no_aset" class="form-control" placeholder="Masukkan No. Aset" required />
                </div>
                <div class="form-group">
                  <label>Merek:</label>
                  <input type="text" name="merek" class="form-control" placeholder="Masukan merek" required />
                </div>
                <div class="form-group">
                  <label>S/N :</label>
                  <input type="text" name="ser_num" class="form-control" placeholder="Masukan S/N" required />
                </div>
                <div class="form-group">
                  <label class="form-label fw-semibold">Status</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="baru" value="baru" checked>
                    <label class="form-check-label" for="baru">
                      Baru
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="lama" value="lama">
                    <label class="form-check-label" for="lama">
                      Lama
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="rusak" value="rusak">
                    <label class="form-check-label" for="rusak">
                      Rusak
                    </label>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <label for="tgl_masuk" class="form-label fw-semibold">
                      Tanggal Masuk
                    </label>
                    <input id="tgl_masuk" class="form-control" type="date" name="tgl_masuk" value="null" />
                  </div>
                  <div class="col">
                    <label for="tgl_keluar" class="form-label fw-semibold">
                      Tanggal Keluar
                    </label>
                    <input id="endDate" class="form-control" type="date" name="tgl_keluar" value="null" />
                  </div>
                </div>

                <input type="hidden" name="table" value="<?php echo $table; ?>" />
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary submit">Tambah</button>
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
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>