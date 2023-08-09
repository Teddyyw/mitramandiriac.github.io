<?php
include 'function.php';
$conn->query("DELETE FROM tbl_merk WHERE merk='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_merk.php';</script>";

?>