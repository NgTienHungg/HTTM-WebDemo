<?php
require_once('connect.php'); // Đảm bảo bạn đã bao gồm tệp connect.php

// Kiểm tra xem có dữ liệu đã gửi từ form hay không
if (isset($_POST['audioName'], $_POST['audioPath'], $_POST['transcriptName'], $_POST['transcriptContent'])) {
    // Nhận các giá trị từ form
    $idSample = $_POST['idSample'];
    $audioName = $_POST['audioName'];
    $audioPath = $_POST['audioPath'];
    $transcriptName = $_POST['transcriptName'];
    $transcriptContent = $_POST['transcriptContent'];

    // Bắt đầu một giao dịch
    $conn->begin_transaction();

    // Truy vấn để lấy giá trị hiện tại từ bảng "audio"
    $sqlSelectCurrentAudio = "SELECT name, path FROM audio WHERE id = (SELECT audioId FROM sample WHERE id = $idSample)";
    $resultCurrentAudio = $conn->query($sqlSelectCurrentAudio);

    // Kiểm tra nếu có kết quả từ truy vấn SELECT
    if ($resultCurrentAudio->num_rows > 0) {
        $row = $resultCurrentAudio->fetch_assoc();
        $currentAudioName = $row['name'];
        $currentAudioPath = $row['path'];
    } else {
        echo "Không tìm thấy giá trị hiện tại cho bảng audio.";
    }

    if ($currentAudioName !== $audioName || $currentAudioPath !== $audioPath) {
        // Có sự thay đổi trong giá trị, nên chúng ta cập nhật cột "lastUpdate"
        $sqlUpdateAudio = "UPDATE audio
                        SET name = '$audioName', path = '$audioPath', lastUpdate = NOW()
                        WHERE id = (SELECT audioId FROM sample WHERE id = $idSample)";

        if ($conn->query($sqlUpdateAudio) === TRUE) {
            // Cập nhật bảng "audio" thành công
        } else {
            echo "Lỗi khi cập nhật bảng audio: " . $conn->error;
            $conn->rollback(); // Quay lại trạng thái ban đầu trong giao dịch
        }
    } else {
        // Không có sự thay đổi, không cần cập nhật "lastUpdate"
    }

    // Truy vấn để lấy giá trị hiện tại từ bảng "transcript"
    $sqlSelectCurrentTranscript = "SELECT name, content FROM transcript WHERE id = (SELECT transcriptId FROM sample WHERE id = $idSample)";
    $resultCurrentTranscript = $conn->query($sqlSelectCurrentTranscript);

    // Kiểm tra nếu có kết quả từ truy vấn SELECT
    if ($resultCurrentTranscript->num_rows > 0) {
        $row = $resultCurrentTranscript->fetch_assoc();
        $currentTranscriptName = $row['name'];
        $currentTranscriptContent = $row['content'];
    } else {
        echo "Không tìm thấy giá trị hiện tại cho bảng transcript.";
    }

    if ($currentTranscriptName !== $transcriptName || $currentTranscriptContent !== $transcriptContent) {
        // Có sự thay đổi trong giá trị, nên chúng ta cập nhật cột "lastUpdate"
        $sqlUpdateTranscript = "UPDATE transcript
                    SET name = '$transcriptName', content = '$transcriptContent', lastUpdate = NOW()
                    WHERE id = (SELECT transcriptId FROM sample WHERE id = $idSample)";

        if ($conn->query($sqlUpdateTranscript) === TRUE) {
            // Cập nhật bảng "transcript" thành công
        } else {
            echo "Lỗi khi cập nhật bảng transcript: " . $conn->error;
            $conn->rollback(); // Quay lại trạng thái ban đầu trong giao dịch
        }
    } else {
        // Không có sự thay đổi, không cần cập nhật "lastUpdate"
    }

    $conn->commit(); // Kết thúc giao dịch
    $conn->close(); // Đóng kết nối cơ sở dữ liệu

    // Chuyển hướng về trang sample.php và hiển thị thông báo thành công
    header("Location: sample.php?id=" . $idSample);
    $_SESSION['update_success'] = true;
    exit();

} else {
    echo "Dữ liệu không hợp lệ.";
}
?>