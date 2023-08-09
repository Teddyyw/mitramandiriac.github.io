<?php
// tambahan
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
require "connection.php";
require "function.php";


if (isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $query = "SELECT * FROM tbl_admin WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usernameloginid'] = $_POST['username'];
        $_SESSION['login'] = true;
        header("location: index.php");
        exit();
    } else {
        echo "<script>alert('Password Salah');</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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

<body>
    <div class="login-container">
        <div class="form-container">
            <h2>Ganti Password</h2>
            <form method="POST">
                <label>Silahkan masukkan password baru anda:</label>
                <input type="password" name="password" class="form-control" required><br>
                <input type="submit" name="resetsandi" value="Reset Sandi">
                <br>
                <br>
                <center>
                    <a class="text-info" href="login.php">Sudah punya akun ? Login</a>
                </center>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST["resetsandi"])) {
    $password = $_POST["password"];
    $con->query("UPDATE tbl_admin SET password='$password' WHERE username='$_GET[id]'") or die(mysqli_error($con));
    echo "<script>alert('Password anda berhasil diperbarui, silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>