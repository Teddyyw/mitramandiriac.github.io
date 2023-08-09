<?php
require 'function.php';
require 'cek.php';
if(!isset($_SESSION['login'])){
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Service AC</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Mitra Mandiri AC</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <a class="navbar-customers ps-3" href="customer/index.php">Halaman Customer</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <hr class="sidebar=divider">
                        <div class="sidebar-heading">
                            Analytic
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr class="sidebar=divider">
                            <div class="sidebar-heading">
                                Data Perusahaan
                                <a class="nav-link" href="data_layanan.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Data Layanan Servis
                                </a>
                                <a class="nav-link" href="data_teknisi.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    Data Teknisi
                                </a>

                                    <hr class="sidebar=divider">
                                    <div class="sidebar-heading">
                                        Data Pemesanan
                                        <a class="nav-link" href="data_jenis_bayar.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        Data Jenis Pembayaran
                                        </a>
                                        <a class="nav-link" href="data_pesanan.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Data Pesanan
                                        </a>
                                        <a class="nav-link" href="data_customer.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        Data Customer
                                        </a>
                                        <hr class="sidebar=divider">
                                    <div class="sidebar-heading">
                                        Admin
                                        <a class="nav-link" href="logout.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Logout
                                        </a>
                                        <a class="nav-link" href="data_feedback.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                            Feedback
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
                <div id="layoutSidenav_content">
                                        <main>
                                            <div class="container-fluid px-4">
                                                <h1 class="mt-4">Data Customer</h1>
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <!-- Button to Open the Modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                            Tambah Data Customer
                                                        </button>
                                                    </div>
                                                        <div class="card-body">
                                                            <table class="table" id="datatablesSimple">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama</th>
                                                                        <th>Alamat</th>
                                                                        <th> No Telpon </th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_customer");
                                                                    $i = 1;
                                                                    while ($data = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                        $nama = $data['nama'];
                                                                        $alamat = $data['alamat'];
                                                                        $no_telp = $data['no_telp'];
                                                                        $idc = $data['id']

                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $i++; ?></td>
                                                                            <td><?php echo $nama; ?></td>
                                                                            <td><?php echo $alamat; ?></td>
                                                                            <td><?php echo $no_telp; ?></td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idc ?>">
                                                                                    Edit
                                                                                </button>
                                                                                <a href="data_customerhapus.php?id=<?= $data["nama"] ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">
                                                                                    Delete
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                        <div class="modal" id="edit<?= $idc ?>">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">

                                                                                    <!-- Modal Header -->
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Edit Data Customer?</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    </div>

                                                                                    <!-- Modal body -->
                                                                                    <form method="post">
                                                                                        <div class="form-group">
                                                                                            <div class="modal-body">
                                                                                                <div class="form-group">
                                                                                                    <label for="nama">Masukan Nama Customer</label>
                                                                                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                                                                    <input type="text" name="nama" value="<?= $nama; ?>" class="form-control" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="alamat">Masukan Alamat Customer</label>
                                                                                                    <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="no_telp">Masukan No Telpon</label>
                                                                                                    <input type="text" name="no_telp" value="<?= $no_telp; ?>" class="form-control" required>
                                                                                                </div>
                                                                                                <button type="submit" class="btn btn-primary" name="editcustomer" value="editcustomer">Submit</button>
                                                                                            </div>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                <?php
                                            };
                                            ?>
                                            </div>
                                            </tbody>
                                            </table>
                                    </div>
                                </div>
                                </div>
                                </main>
                                <footer class="py-4 bg-light mt-auto">
                                    <div class="container-fluid px-4">
                                        <div class="d-flex align-items-center justify-content-between small">
                                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                                            <div>
                                                <a href="#">Privacy Policy</a>
                                                &middot;
                                                <a href="#">Terms &amp; Conditions</a>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                                </div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                                <script src="js/scripts.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                                <script src="assets/demo/chart-area-demo.js"></script>
                                <script src="assets/demo/chart-bar-demo.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
                                <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                                <script src="js/datatables-simple-demo.js"></script>
                            </body>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tambah Data Customer</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <label for="nama">Masukan Nama Customer</label>
                                                <input type="text" name="nama" placeholder="Nama" class="form-control" required>
                                                <br>
                                                <label for="alamat">Masukan Alamat Customer</label>
                                                <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
                                                <br>
                                                <label for="no_telp">Masukan No Telpon</label>
                                                <input type="text" name="no_telp" placeholder="No Telpon" class="form-control" required>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="addnewcustomer">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            </html>