<?php
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
            <h2>Login</h2>
            <form method="POST">
                <label>Username:</label>
                <input type="text" name="username" required><br><br>
                <label>Password:</label>
                <input type="password" name="password" required><br><br>
                <input type="submit" name="login" value="Login">
                <br>
                <br>
                <center>
                    <a class="text-info" href="lupapassword.php">Lupa Password ? Reset Sandi</a>
                </center>
            </form>
        </div>
    </div>
</body>

</html>