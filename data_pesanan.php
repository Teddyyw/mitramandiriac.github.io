<?php
require 'function.php';
require 'cek.php';
$hariini = date('Y-m-d');
if (!isset($_SESSION['login'])) {
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
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                    <h1 class="mt-4">Data Pesanan</h1>
                    <form method="post">
                        <div class="row mt-3 mb-3">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Pilih Teknisi</label>
                                    <select name="teknisi" class="form-control" id="teknisi">
                                        <option value="">Semua</option>
                                        <?php
                                        $ambil_teknisi = $conn->query("SELECT * FROM tbl_teknisi");
                                        while ($data_teknisi = $ambil_teknisi->fetch_assoc()) {
                                            $selected = (isset($_POST['teknisi']) && $_POST['teknisi'] === $data_teknisi['id']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $data_teknisi['id'] ?>" <?= $selected ?>><?= $data_teknisi['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Pilih Jenis Layanan</label>
                                    <select name="jenis_layanan" class="form-control" id="jenis_layanan">
                                        <option value="">Semua</option>
                                        <?php
                                        $ambil_layanan = $conn->query("SELECT * FROM tbl_layanan");
                                        while ($data_layanan = $ambil_layanan->fetch_assoc()) {
                                            $selected_layanan = (isset($_POST['jenis_layanan']) && $_POST['jenis_layanan'] === $data_layanan['id']) ? 'selected' : '';
                                        ?>
                                            <option <?= $selected_layanan ?> value="<?= $data_layanan['id'] ?>"><?= $data_layanan['jenis_layanan'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-white" style="margin-top:30px">Cari</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data Pesanan
                            </button>
                            <?php $selected_teknisi = (isset($_POST['teknisi'])) ? $_POST['teknisi'] : '';
                            $selected_layanan = (isset($_POST['jenis_layanan'])) ? $_POST['jenis_layanan'] : ''; ?>
                            <a href="download_pdf.php?teknisi=<?= $selected_teknisi ?>&jenis_layanan=<?= $selected_layanan ?>" class="btn btn-success" target="_blank">
                                Download PDF
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tabel">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Servis</th>
                                            <th>Jam Servis</th>
                                            <th>Nomor Telepon</th>
                                            <th>Nama Customer</th>
                                            <th>Jenis Layanan</th>
                                            <th>Nama Teknisi</th>
                                            <th>Jenis Bayar</th>
                                            <th>Harga</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        $selected_teknisi = (isset($_POST['teknisi'])) ? $_POST['teknisi'] : '';
                                        $selected_layanan = (isset($_POST['jenis_layanan'])) ? $_POST['jenis_layanan'] : '';
                                        $query = "SELECT * FROM tbl_pesanan LEFT JOIN tbl_customer ON tbl_pesanan.id_customer = tbl_customer.id ";
                                        // Add the WHERE clause to filter by selected technician, if provided
                                        if (!empty($selected_teknisi)) {
                                            $query .= " WHERE tbl_pesanan.id_teknisi = '$selected_teknisi'";
                                        }

                                        if (!empty($selected_layanan)) {
                                            if (!empty($selected_teknisi)) {
                                                $query .= " AND ";
                                            } else {
                                                $query .= " WHERE ";
                                            }
                                            $query .= " tbl_pesanan.id_layanan = '$selected_layanan'";
                                        }

                                        $query .= " ORDER BY tbl_pesanan.tgl_servis DESC, tbl_pesanan.id_pesanan DESC";
                                        $ambil = $conn->query($query);
                                        while ($data = $ambil->fetch_assoc()) {
                                            $layanan = $conn->query("SELECT * FROM tbl_layanan WHERE id='$data[id_layanan]'");
                                            $layananac = $layanan->fetch_assoc();

                                            $jenisbayar = $conn->query("SELECT * FROM tbl_jenis_bayar WHERE id='$data[id_jenis_bayar]'");
                                            $jenisbayarac = $jenisbayar->fetch_assoc();

                                            $teknisi = $conn->query("SELECT * FROM tbl_teknisi WHERE id='$data[id_teknisi]'");
                                            $teknisiac = $teknisi->fetch_assoc();
                                            // tambahan
                                            if ($data['terakhirnotice'] != 'Belum') {
                                                $terakhirnotice = $onemonthBefore = date('Y-m-d', strtotime($data["terakhirnotice"] . ' +90 day'));
                                                $date1 = new DateTime($data["terakhirnotice"]);
                                                $date2 = new DateTime($hariini);
                                                $interval = $date1->diff($date2);
                                                $days = $interval->days;
                                                $warna = "text-dark";
                                                if ($days >= 90) {
                                                    $warna = "text-danger"; // Set the color to red
                                                } else {
                                                    $warna = "text-dark"; // Set the default color
                                                }
                                            } else {
                                                $warna = "text-danger";
                                            }
                                        ?>
                                            <tr class="<?= $warna ?>">
                                                <td><?php echo $nomor ?></td>
                                                <td><?php echo $data["tgl_servis"] ?></td>
                                                <td><?php echo $data["jam_servis"] ?></td>
                                                <td><?php echo $data["no_telp"] ?></td>
                                                <td><?php echo $data["nama"] ?></td>
                                                <td><?php echo $layananac["jenis_layanan"] ?></td>
                                                <td><?php echo $teknisiac["nama"] ?></td>

                                                <td><?php echo $jenisbayarac["jenis_bayar"] ?></td>
                                                <td><?php echo rupiah($data["harga"]) ?></td>
                                                <td><?php echo $data["alamatt"] ?></td>
                                                <td>
                                                    <!-- tambahan -->
                                                    <a class="btn btn-info btn-sm m-1" href="notice.php?id=<?= $data["id_pesanan"] ?>">
                                                        Notice
                                                    </a>
                                                    <a href="button" class="btn btn-warning btn-sm m-1" data-toggle="modal" data-target="#edit<?= $nomor ?>">
                                                        Edit
                                                    </a>
                                                    <a href="data_pesananhapus.php?id=<?= $data["id_pesanan"] ?>" class="btn btn-danger btn-sm m-1" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')">
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>

                                            <div class="modal" id="edit<?= $nomor ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Pesanan</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="tgl_servis">Tanggal Servis</label>
                                                                    <input type="hidden" name="id_pesanan" value="<?= $data['id_pesanan'] ?>">
                                                                    <input type="date" name="tgl_servis" placeholder="Tanggal Servis" class="form-control" value="<?php echo $data["tgl_servis"] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam_servis">Jam Servis</label>
                                                                    <input type="time" name="jam_servis" placeholder="Jam Servis" value="<?php echo $data["jam_servis"] ?>" class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_telp">Nomor Telepon</label>
                                                                    <select name="no_telp" class="form-control" required>
                                                                        <option value="">Pilih</option>
                                                                        <?php
                                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_customer");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                            $notelp = $fetcharray['no_telp'];
                                                                            $id_customer = $fetcharray['id'];
                                                                        ?>
                                                                            <option <?php if ($data['id_customer'] == $id_customer) echo 'selected'; ?> value="<?= $id_customer ?>"><?= $notelp ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_customer">Nama Customer</label>
                                                                    <select name="id_customer" class="form-control" required>
                                                                        <option value="">Pilih</option>
                                                                        <?php
                                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_customer");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                            $nama = $fetcharray['nama'];
                                                                            $id_customer = $fetcharray['id'];
                                                                        ?>
                                                                            <option <?php if ($data['id_customer'] == $id_customer) echo 'selected'; ?> value="<?= $id_customer ?>"><?= $nama ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_layanan">Jenis Layanan</label>
                                                                    <select name="id_layanan" class="form-control layanan_ac" required>
                                                                        <option value="">Jenis Servis</option>
                                                                        <?php
                                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_layanan");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                            $layananac = $fetcharray['jenis_layanan'];
                                                                            $harga = $fetcharray['harga'];
                                                                            $id_layanan = $fetcharray['id'];
                                                                        ?>
                                                                            <option <?php if ($data['id_layanan'] == $id_layanan) echo 'selected'; ?> value="<?= $id_layanan ?>" data-harga="<?= $harga ?>"><?= $layananac; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_teknisi">Nama Teknisi</label>
                                                                    <select name="id_teknisi" class="form-control" required>
                                                                        <option value="">Pilih</option>
                                                                        <?php
                                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_teknisi");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                            $nama = $fetcharray['nama'];
                                                                            $id_teknisi = $fetcharray['id'];
                                                                        ?>
                                                                            <option <?php if ($data['id_teknisi'] == $id_teknisi) echo 'selected'; ?> value="<?= $id_teknisi ?>"><?= $nama ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_layanan">Harga</label>
                                                                    <input type="text" name="harga" class="form-control harga" value="<?php echo $data["harga"] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_layanan">Alamat</label>
                                                                    <textarea name="alamatt" class="form-control" value="<?php echo $data["alamatt"] ?>"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="id_jenis_bayar">Jenis Bayar</label>
                                                                    <select name="id_jenis_bayar" class="form-control" required>
                                                                        <option value="">Pilih</option>
                                                                        <?php
                                                                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_jenis_bayar");
                                                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                                                            $jenis_bayar = $fetcharray['jenis_bayar'];
                                                                            $id_jenis_bayar = $fetcharray['id'];
                                                                        ?>
                                                                            <option <?php if ($data['id_jenis_bayar'] == $id_jenis_bayar) echo 'selected'; ?> value="<?= $id_jenis_bayar ?>"><?= $jenis_bayar; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="editpesanan" value="editpesanan">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $nomor++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
                <h4 class="modal-title">Tambah Data Pesanan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <label for="tgl_servis">Tanggal Servis</label>
                    <input type="date" name="tgl_servis" placeholder="Tanggal Servis" class="form-control" required>
                    <label for="jam_servis">Jam Servis</label>
                    <input type="time" name="jam_servis" placeholder="Jam Servis" class="form-control" required>
                    <label for="id_customer">Nama Customer</label>
                    <select name="id_customer" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_customer");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $nama = $fetcharray['nama'];
                            $id_customer = $fetcharray['id'];
                        ?>
                            <option value="<?= $id_customer ?>"><?= $nama ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="id_layanan">Jenis Layanan</label>
                    <select name="id_layanan" id="layanan_ac" class="form-control" required>
                        <option value="">Pilih Layanan</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_layanan");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $layananac = $fetcharray['jenis_layanan'];
                            $harga = $fetcharray['harga'];
                            $id_layanan = $fetcharray['id'];
                        ?>
                            <option value="<?= $id_layanan ?>" data-harga="<?= $harga ?>"><?= $layananac; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="id_teknisi">Nama Teknisi</label>
                    <select name="id_teknisi" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_teknisi");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $nama = $fetcharray['nama'];
                            $id_teknisi = $fetcharray['id'];
                        ?>
                            <option value="<?= $id_teknisi ?>"><?= $nama ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label for="id_layanan">Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" readonly>
                    <label for="alamatt">Alamat</label>
                    <textarea name="alamatt" placeholder="Alamat" class="form-control" required></textarea>
                    <label for="id_jenis_bayar">Jenis Bayar</label>
                    <select name="id_jenis_bayar" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from tbl_jenis_bayar");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $jenis_bayar = $fetcharray['jenis_bayar'];
                            $id_jenis_bayar = $fetcharray['id'];
                        ?>
                            <option value="<?= $id_jenis_bayar ?>"><?= $jenis_bayar; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewpesanan">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    document.getElementById('layanan_ac').addEventListener('change', function() {
        var select = document.getElementById('layanan_ac');
        var selectedOption = select.options[select.selectedIndex];
        document.getElementById('harga').value = selectedOption.getAttribute('data-harga');
    });

    $(document).ready(function() {
        $('.layanan_ac').change(function() {
            var harga = $(this).find(':selected').data('harga');
            $('.harga').val(harga);
        });
    });
    $(document).ready(function() {
        $('#tabel').DataTable();
    });
</script>