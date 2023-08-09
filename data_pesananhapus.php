<?php
include 'function.php';
$conn->query("DELETE FROM tbl_pesanan WHERE id_pesanan='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_pesanan.php';</script>";
