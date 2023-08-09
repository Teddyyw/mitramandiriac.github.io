<?php
require 'function.php';
require 'cek.php';
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <?php
                    // tambahan
                    if (isset($_POST['submit'])) {
                        $year = $_POST['year'];
                    } else {
                        $hariini = date('Y-m-d');
                        $year = date('Y');
                    }
                    ?>
                    <?php
                    // tambahan
                    $ambilpesanan = $conn->query("SELECT * from tbl_pesanan where year(tgl_servis) = '$year'") or die(mysqli_error($conn));
                    $totalpesanan = $ambilpesanan->num_rows;
                    $ambilcustomer = $conn->query("SELECT * from tbl_customer") or die(mysqli_error($conn));
                    $totalcustomer = $ambilcustomer->num_rows;
                    $ambilteknisi = $conn->query("SELECT * from tbl_teknisi") or die(mysqli_error($conn));
                    $totalteknisi = $ambilteknisi->num_rows;
                    $ambillayanan = $conn->query("SELECT * from tbl_layanan") or die(mysqli_error($conn));
                    $totallayanan = $ambillayanan->num_rows;
                    // tambahan
                    $pendapatan = "SELECT SUM(harga) AS total_pendapatan FROM tbl_pesanan where year(tgl_servis) = '$year'";
                    $hasil = mysqli_query($conn, $pendapatan);
                    $row = mysqli_fetch_assoc($hasil);
                    $totalpendapatan = $row['total_pendapatan'];
                    $totalpendapatanr = "Rp " . number_format($totalpendapatan, 0, ',', '.');
                    ?>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    Total Pesanan
                                    <h4><?= $totalpesanan ?></h4>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="data_pesanan.php">Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    Total Teknisi
                                    <h4><?= $totalteknisi ?></h4>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="data_teknisi.php">Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    Total Layanan
                                    <h4><?= $totallayanan ?></h4>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="data_layanan.php">Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-5">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    Total Customer
                                    <h4><?= $totalcustomer ?></h4>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="data_customer.php">Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-5">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    Total Pendapatan
                                    <h4><?= $totalpendapatanr ?></h4>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="data_pesanan.php">Detail</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Grafik Pesanan
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="row mt-3 mb-3">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2">Year</label>
                                                    <select class="form-control" name="year" style="background-color: #97CBA9;" required>
                                                        <?php
                                                        $nomor = 1;
                                                        $yearawal = 2017;
                                                        $yearakhir = date('Y');
                                                        while ($yearakhir >= $yearawal) {
                                                        ?>
                                                            <option <?php if ($year == $yearakhir) echo 'selected'; ?> value="<?= $yearakhir ?>"><?= $yearakhir ?></option>
                                                        <?php
                                                            $yearakhir = $yearakhir - 1;
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <button type="submit" name="submit" value="submit" class="btn btn text-white" style="margin-top:30px;background-color: #668BA4">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php
                                    $pendapatan = "SELECT MONTH(tgl_servis) AS bulan, COUNT(*) AS total_pesanan, SUM(harga) AS total_pendapatan FROM tbl_pesanan WHERE YEAR(tgl_servis) = '$year' GROUP BY MONTH(tgl_servis)";
                                    $hasil = mysqli_query($conn, $pendapatan);
                                    $dataPointsPesanan = array();
                                    $dataPointsPendapatan = array();
                                    while ($row = mysqli_fetch_assoc($hasil)) {
                                        $bulan = $row['bulan'];
                                        $totalPesanan = $row['total_pesanan'];
                                        $totalPendapatan = $row['total_pendapatan'];
                                        $dataPointsPesanan[] = array("label" => date('F', mktime(0, 0, 0, $bulan, 1)), "y" => $totalPesanan);
                                        $dataPointsPendapatan[] = array("label" => date('F', mktime(0, 0, 0, $bulan, 1)), "y" => $totalPendapatan);
                                    }
                                    ?>
                                    <div style="overflow: auto;">
                                        <div id="chartContainer" style="height: 500px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-4">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Mitra Mandiri AC 2023</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="js/datatables-simple-demo.js"></script>
                    <script>
                        window.onload = function() {
                            var chart = new CanvasJS.Chart("chartContainer", {
                                animationEnabled: true,
                                axisY: {
                                    title: "",
                                    titleFontColor: "#4F81BC",
                                    lineColor: "#4F81BC",
                                    labelFontColor: "#4F81BC",
                                    tickColor: "#4F81BC"
                                },
                                title: {
                                    text: "Grafik Pendapatan <?= $year ?>"
                                },
                                axisY2: {
                                    title: "",
                                    titleFontColor: "#C0504E",
                                    lineColor: "#C0504E",
                                    labelFontColor: "#C0504E",
                                    tickColor: "#C0504E"
                                },
                                exportEnabled: true,
                                toolTip: {
                                    shared: true
                                },
                                legend: {
                                    cursor: "pointer",
                                    itemclick: toggleDataSeries
                                },
                                data: [{
                                    type: "line",
                                    name: "Total Pendapatan",
                                    indexLabel: "{y}",
                                    indexLabelFontColor: "red",
                                    showInLegend: true,
                                    axisYType: "secondary",
                                    dataPoints: <?php echo json_encode($dataPointsPendapatan, JSON_NUMERIC_CHECK); ?>
                                }],
                            });
                            chart.render();

                            function toggleDataSeries(e) {
                                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                    e.dataSeries.visible = false;
                                } else {
                                    e.dataSeries.visible = true;
                                }
                                chart.render();
                            }
                        }
                    </script>

                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>