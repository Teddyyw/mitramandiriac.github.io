<?php
include 'function.php';
$conn->query("DELETE FROM tbl_customer WHERE nama='$_GET[id]'");
echo "<script>alert('Data Berhasil Di Hapus');</script>";
echo "<script>location='data_customer.php';</script>";

?>