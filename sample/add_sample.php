<!DOCTYPE html>
<html>

<head>
    <title>Thêm Mẫu Mới</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>

<body>
    <!-- Header -->
    <div id="header">
        <a href="home.php" class="back-button">Trang chủ</a>
        <span class="page-title">THÊM MẪU MỚI</span>
    </div>

    <!-- Form để thêm mẫu mới -->
    <form method="post" action="process_add_sample.php">
        <div id="sample-info-container">
            <!-- Trường để nhập tên Audio -->
            <div class="info-item audio-info">
                <h1>Audio</h1>
                <p><strong>Tên:</strong>
                    <input type="text" class="full-width-input" name="audioName" required>
                </p>
                <p><strong>Đường link:</strong>
                    <input type="text" class="full-width-input" name="audioPath" required>
                </p>
                <!-- Các trường thời gian sẽ được tạo tự động khi thêm mẫu mới -->
            </div>

            <!-- Trường để nhập tên Transcript -->
            <div class="info-item transcript-info">
                <h1>Transcript</h1>
                <p><strong>Tên:</strong>
                    <input type="text" class="full-width-input" name="transcriptName" required>
                </p>
                <p><strong>Nội dung:</strong></p>
                <textarea class="transcript-content" rows="10" cols="100" name="transcriptContent" required></textarea>
            </div>
        </div>

        <!-- Nút "Thêm" để thêm mẫu mới -->
        <div class="button-wrapper">
            <button type="submit" class="add-button">Thêm</button>
        </div>
    </form>

    <script src="add_sample.js"></script>
</body>

</html>