<?php
require_once('connect.php'); // Kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteSample'])) {
    $idSample = $_POST['idSample'];

    // Thực hiện truy vấn DELETE để xoá mẫu dựa trên ID
    $deleteSql = "DELETE FROM sample WHERE id = $idSample";
    if ($conn->query($deleteSql) === TRUE) {
        // Xoá thành công, chuyển hướng về trang home.php
        header("Location: home.php");
        exit();
    } else {
        echo "Lỗi khi xoá mẫu: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>
