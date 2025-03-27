<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["user"] = $username;
        header("Location: index.php");
    } else {
        echo "Sai tài khoản hoặc mật khẩu!";
    }
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Tài khoản" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
</form>
