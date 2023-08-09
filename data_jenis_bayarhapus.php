<?php
include 'function.php';
$conn->query("DELETE FROM tbl_jenis_bayar WHERE jenis_bayar ='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_jenis_bayar.php';</script>";

?>