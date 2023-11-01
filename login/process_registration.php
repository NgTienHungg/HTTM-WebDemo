<?php
session_start(); // Bắt đầu phiên làm việc của session
require_once('../connect.php'); // Nhúng file kết nối tới database
require_once 'AccountManager.php';

// Lấy thông tin từ biểu mẫu
$newUsername = $_POST['new-username'];
$newPassword = $_POST['new-password'];
$confirmPassword = $_POST['confirm-password'];

// Kiểm tra xem mật khẩu và nhập lại mật khẩu có khớp nhau không
if ($newPassword !== $confirmPassword) {
    $_SESSION['error'] = "Mật khẩu không khớp. Vui lòng thử lại.";
    header("Location: register.php");
    exit;
}

// Tạo một đối tượng Account
$accountManager = new AccountController($conn);

// Kiểm tra xem tài khoản đã tồn tại trong cơ sở dữ liệu chưa
if ($accountManager->isUsernameTaken($newUsername)) {
    $_SESSION['error'] = "Tài khoản đã tồn tại. Vui lòng chọn tên đăng nhập khác.";
    header("Location: register.php");
    exit;
}

// Nếu tài khoản chưa tồn tại, thêm nó vào bảng "account"
if ($accountManager->saveToDatabase($newUsername, $newPassword)) {
    $_SESSION['success'] = "Đăng ký thành công!";
    header("Location: ../index.php");
} else {
    $_SESSION['error'] = "Lỗi khi thêm tài khoản: " . $conn->error;
    header("Location: register.php");
}

// Đóng kết nối
$conn->close();
?>