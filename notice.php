<?php
// tambahan
include 'function.php';
$ambil = $conn->query("SELECT * FROM tbl_pesanan WHERE id_pesanan='$_GET[id]'");
$data = $ambil->fetch_assoc();
if ($data['terakhirnotice'] == 'Belum') {
    $terakhirnotice = date('Y-m-d');
} else {
    $terakhirnotice = 'Belum';
}
$$addtodata_pesanan = mysqli_query($conn, "UPDATE tbl_pesanan SET terakhirnotice = '$terakhirnotice' WHERE id_pesanan = '$_GET[id]'") or die(mysqli_error($conn));
echo "<script>alert('Pesanan Berhasil Di Notice');</script>";
echo "<script>location='data_pesanan.php';</script>";
