<?php
require_once('../connect.php'); // Kết nối đến cơ sở dữ liệu
require_once "SampleController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteSample'])) {
    $idSample = $_POST['idSample'];

    // Tạo một thể hiện của SampleController và gọi phương thức deleteSample
    $sampleController = new SampleController($conn);
    $result = $sampleController->deleteSample($idSample);

    if ($result) {
        // Xoá thành công, chuyển hướng về trang home.php
        header("Location: home.php");
        exit();
    } else {
        echo "Lỗi khi xoá mẫu.";
    }
}

// Đóng kết nối
$conn->close();
?>