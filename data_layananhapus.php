<?php
include 'function.php';
$conn->query("DELETE FROM tbl_layanan WHERE jenis_layanan ='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_layanan.php';</script>";

?>