<?php
session_start(); // Bắt đầu phiên làm việc của session
require_once '../connect.php'; // Kết nối đến cơ sở dữ liệu MySQL
require_once 'AccountDAO.php';

// Lấy dữ liệu từ biểu mẫu đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];

// Tạo một đối tượng Account
$accountManager = new AccountDAO($conn);

if ($accountManager->authenticate($username,$password)) {
    // Tài khoản hợp lệ
    $_SESSION['username'] = $username;
    header("Location: ../sample/home.php"); // Chuyển hướng đến trang khác
} else {
    // Tài khoản không hợp lệ
    $_SESSION['error'] = "Tài khoản hoặc mật khẩu không đúng.";
    header("Location: ../index.php");
}

$conn->close();
?>