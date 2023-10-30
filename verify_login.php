<?php
session_start(); // Bắt đầu phiên làm việc của session
require_once('connect.php'); // Kết nối đến cơ sở dữ liệu MySQL

// Lấy dữ liệu từ biểu mẫu đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra tài khoản trong cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Tài khoản hợp lệ
    $_SESSION['username'] = $username;
    header("Location: home.php"); // Chuyển hướng đến trang khác
} else {
    // Tài khoản không hợp lệ
    $_SESSION['error'] = "Tài khoản hoặc mật khẩu không đúng.";
    header("Location: index.php");
}

$stmt->close();
$conn->close();
?>