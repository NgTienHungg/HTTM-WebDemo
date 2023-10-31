<?php
session_start();
require_once('connect.php');

// Kiểm tra xem người dùng đã đăng nhập hay chưa. Nếu chưa, chuyển hướng về trang đăng nhập hoặc trang khác.
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Kiểm tra xem idSample đã được thiết lập trong GET hay chưa. Nếu chưa, chuyển hướng về trang trước hoặc trang khác.
if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$idSample = $_GET['id'];

// Truy vấn cơ sở dữ liệu để lấy thông tin của mẫu dựa trên idSample
$sql = "SELECT audio.name AS audioName, audio.path AS audioPath, audio.date AS audioCreateTime, audio.lastUpdate AS audioLastUpdate, transcript.name AS transcriptName, transcript.content AS transcriptContent, transcript.date AS transcriptCreateTime, transcript.lastUpdate AS transcriptLastUpdate
        FROM sample
        JOIN audio ON sample.audioId = audio.id
        JOIN transcript ON sample.transcriptId = transcript.id
        WHERE sample.id = $idSample";

// Thực hiện truy vấn SQL
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $audioName = $row['audioName'];
    $audioPath = $row['audioPath'];
    $audioCreateTime = date("H:i:s d/m/Y", strtotime($row['audioCreateTime']));
    $audioLastUpdate = date("H:i:s d/m/Y", strtotime($row['audioLastUpdate']));
    $transcriptName = $row['transcriptName'];
    $transcriptContent = $row['transcriptContent'];
    $transcriptCreateTime = date("H:i:s d/m/Y", strtotime($row['transcriptCreateTime']));
    $transcriptLastUpdate = date("H:i:s d/m/Y", strtotime($row['transcriptLastUpdate']));
} else {
    // Xử lý trường hợp không tìm thấy thông tin mẫu.
    // Có thể chuyển hướng về trang 404 hoặc hiển thị thông báo lỗi khác.
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thông tin mẫu</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>

<body>
    <!-- Header -->
    <div id="header">
        <a href="home.php" class="back-button">Trang chủ</a>
        <span class="page-title">THÔNG TIN MẪU</span>
        <a href="index.php" class="logout-button">Đăng xuất</a>
    </div>

    <!-- Hiển thị thông tin mẫu -->
    <form method="post" action="update_data.php">
        <div id="sample-info-container">

            <!-- khai báo idSample để truyền vào form -->
            <input type="hidden" name="idSample" value="<?php echo $idSample; ?>">

            <div class="info-item audio-info">
                <h1>Audio</h1>
                <p><strong>Tên:</strong>
                    <input type="text" id="audio-name" class="full-width-input" name="audioName"
                        value="<?php echo $audioName; ?>" readonly>
                </p>
                <p><strong>Đường link:</strong>
                    <input type="text" id="audio-path" class="full-width-input" name="audioPath"
                        value="<?php echo $audioPath; ?>" readonly>

                    <!-- <a id="audio-link" href="<?php echo $audioPath; ?>" target="_blank"><?php echo $audioPath; ?></a> -->
                </p>
                <p><strong>Thời gian tạo:</strong>
                    <?php echo $audioCreateTime; ?>
                </p>
                <p><strong>Cập nhật cuối:</strong>
                    <?php echo $audioLastUpdate; ?>
                </p>
            </div>

            <div class="info-item transcript-info">
                <h1>Transcript</h1>
                <p><strong>Tên:</strong>
                    <input type="text" id="transcript-name" class="full-width-input" name="transcriptName"
                        value="<?php echo $transcriptName; ?>" readonly>
                </p>
                <p><strong>Nội dung:</strong></p>
                <textarea id="transcript-content" class="transcript-content" rows="10" cols="100"
                    name="transcriptContent" readonly><?php echo $transcriptContent; ?></textarea>
                <!-- Bất kỳ trường nào bạn muốn cập nhật cũng cần thêm ở đây -->
                <p><strong>Thời gian tạo:</strong>
                    <?php echo $transcriptCreateTime; ?>
                </p>
                <p><strong>Cập nhật cuối:</strong>
                    <?php echo $transcriptLastUpdate; ?>
                </p>
            </div>
            <!-- Hiển thị nút "Xoá" và "Sửa" -->

            <div class="button-container">
                <form method="post" action="delete_sample.php">
                    <input type="hidden" name="idSample" value="<?php echo $idSample; ?>">
                    <button type="submit" name="deleteSample" class="delete-button">Xoá</button>
                </form>
                <button id="edit-button" class="edit-button" onclick="toggleEditing()">Sửa</button>

                <?php
                // Kiểm tra xem có Session "update_success" đã được đặt hay chưa
                if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
                    echo '<div style="color: green;">Cập nhật thành công</div>';
                    // Đặt lại Session để không hiển thị thông báo lại nếu người dùng làm mới trang
                    $_SESSION['update_success'] = false;
                }
                ?>
            </div>
        </div>
    </form>
    <script src="sample.js"></script>
</body>

</html>