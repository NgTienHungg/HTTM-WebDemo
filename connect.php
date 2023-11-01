<?php

$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "httm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo '<script>alert("Kết nối thất bại: ' . $conn->connect_error . '");</script>';
}

?>