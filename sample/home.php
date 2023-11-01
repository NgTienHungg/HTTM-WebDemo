<?php
session_start();
require_once '../connect.php';
require_once 'Sample.php';
require_once 'SampleDAO.php';

$sampleController = new SampleDAO($conn);
$samples = $sampleController->getAllSamples();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Trang chủ</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>

<body>
    <!-- Header -->
    <div id="header">
        <?php
        if (isset($_SESSION['username'])) {
            echo "Xin chào, " . $_SESSION['username'];
        } else {
            echo "Xin chào, guest";
        }
        ?>
        <span class="page-title">QUẢN LÝ MẪU</span>
        <a href="add_sample.php" class="add-sample-button">Thêm mẫu</a>
        <a href="../login/login.php" class="logout-button">Đăng xuất</a>
    </div>

    <!-- Bảng danh sách âm thanh -->
    <table id="audioTable">
        <!-- Tạo các cột cho bảng -->
        <tr>
            <th style="width: 10%;">STT</th>
            <th style="width: 20%;">Name</th>
            <th style="width: 60%;">Content</th>
            <th style="width: 10%;">Action</th>
        </tr>

        <?php
        if (!empty($samples)) {
            $stt = 1; // Biến đếm dùng cho cột Stt
            foreach ($samples as $sample) {
                echo '<tr>';
                echo '<td>' . $stt . '</td>'; // Cột Stt
                echo '<td>' . $sample->getAudioName() . '</td>'; // Cột Tên audio
                echo '<td>' . substr($sample->getTranscriptContent(), 0, 80) . '...</td>'; // Cột Content
                echo '<td><a href="sample_info.php?id=' . $sample->getId() . '" class="audio-view">Xem</a></td>'; // Cột Lựa chọn (Xem)
                echo '</tr>';
                $stt++; // Tăng biến đếm Stt
            }
        } else {
            echo '<tr><td colspan="4">Không có dữ liệu.</td></tr>';
        }


        // if ($result->num_rows > 0) {
        //     $stt = 1; // Biến đếm dùng cho cột Stt
        //     while ($row = $result->fetch_assoc()) {
        //         echo '<tr>';
        //         echo '<td>' . $stt . '</td>'; // Cột Stt
        //         echo '<td>' . $row['audio_name'] . '</td>'; // Cột Tên audio
        //         echo '<td>' . substr($row['content'], 0, 80) . '...</td>'; // Cột Content
        //         echo '<td><a href="sample.php?id=' . $row['sample_id'] . '" class="audio-view">Xem</a></td>'; // Cột Lựa chọn (Xem)
        //         echo '</tr>';
        //         $stt++; // Tăng biến đếm Stt
        //     }
        // } else {
        //     echo '<tr><td colspan="4">Không có dữ liệu.</td></tr>';
        // }
        ?>
    </table>
</body>

</html>