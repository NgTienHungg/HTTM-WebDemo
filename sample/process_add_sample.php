<?php
require_once('../connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $audioName = $_POST['audioName'];
    $audioPath = $_POST['audioPath']; // Sửa dòng này để lấy dữ liệu từ form
    $transcriptContent = $_POST['transcriptContent'];
    $transcriptName = $_POST['transcriptName']; // Sửa dòng này để lấy dữ liệu từ form

    // Thực hiện thêm dữ liệu vào bảng Audio
    $audioInsertSql = "INSERT INTO audio (name, path, date, lastUpdate) 
                       VALUES ('$audioName', '$audioPath', NOW(), NOW())";

    if ($conn->query($audioInsertSql) === TRUE) {
        // Lấy ID của bản ghi vừa thêm vào bảng Audio
        $audioId = $conn->insert_id;

        // Thực hiện thêm dữ liệu vào bảng Transcript
        $transcriptInsertSql = "INSERT INTO transcript (name, content, date, lastUpdate) 
                                VALUES ('$transcriptName', '$transcriptContent', NOW(), NOW())";

        if ($conn->query($transcriptInsertSql) === TRUE) {
            // Lấy ID của bản ghi vừa thêm vào bảng Transcript
            $transcriptId = $conn->insert_id;

            // Thực hiện thêm dữ liệu vào bảng Sample
            $sampleInsertSql = "INSERT INTO sample (name, audioId, transcriptId, date, lastUpdate) 
                                VALUES ('$audioName', $audioId, $transcriptId, NOW(), NOW())";

            if ($conn->query($sampleInsertSql) === TRUE) {
                // Thêm mẫu thành công
                header("Location: home.php"); // Chuyển hướng đến trang thành công
                exit();
            } else {
                echo "Lỗi khi thêm vào bảng Sample: " . $conn->error;
            }
        } else {
            echo "Lỗi khi thêm vào bảng Transcript: " . $conn->error;
        }
    } else {
        echo "Lỗi khi thêm vào bảng Audio: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>