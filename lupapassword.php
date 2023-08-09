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
            <h2>Lupa Password</h2>
            <form method="POST">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required><br>
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
    $email = $_POST["email"];
    $ambil = $con->query("SELECT * FROM tbl_admin
		WHERE email='$email'");
    $akunyangcocok = $ambil->num_rows;
    if ($akunyangcocok >= 1) {
        $akun = $ambil->fetch_assoc();
        // kirimemail
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'imartiraha03@gmail.com';
        $mail->Password = 'yycqdzzqesydemrt';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('imartiraha03@gmail.com', 'Website Servis Mitra Mandiri AC');
        $mail->addAddress($email);
        $mail->addReplyTo('no-reply@gmail.com', 'Np-reply');
        $mail->isHTML(true);
        $mail->Subject = 'Ganti Password Akun Website Servis Mitra Mandiri AC - ' . $email;
        // $mail->Body    = "Silahkan ganti password anda";
        $mail->Body    = 'Silahkan klik link ini untuk mengganti password baru akun anda<br><br><a href="http://localhost/mitramandiriac2/gantipassword.php?id=' . $akun['username'] . '" target="_blank" style="background-color: #1ba4e3;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;">Ganti Password</a>';
        $mail->AltBody = '';
        if (!$mail->send()) {
            echo 'Gagal';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        // 
        echo "<script>alert('Link ganti password berhasil dikirim silahkan cek email anda untuk mengganti password');</script>";
        echo "<script>location='login.php';</script>";
    } else {
        echo "<script>alert('Email anda tidak terdaftar dalam sistem kami');</script>";
        echo "<script>location='lupapassword.php';</script>";
    }
}
?>