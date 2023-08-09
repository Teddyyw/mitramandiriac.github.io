<!-- logout.php -->
<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Arahkan admin ke halaman login
header("location: login.php");
exit();
?>