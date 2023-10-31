<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "httm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    // Nếu kết nối thất bại, chuyển hướng người dùng đến trang lỗi
    // header("Location: error.html");
    // die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);

    echo '<script>alert("Kết nối thất bại: ' . $conn->connect_error . '");</script>';
}