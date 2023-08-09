<?php
include 'function.php';
$conn->query("DELETE FROM tbl_teknisi WHERE nama='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_teknisi.php';</script>";

?>