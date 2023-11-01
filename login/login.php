<?php
session_start(); // Bắt đầu phiên làm việc của session
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="login-container">
        <h1>Đăng nhập</h1>

        <!-- Kiểm tra xem session 'error' có tồn tại không -->
        <?php if (isset($_SESSION['error'])) { ?>
            <span style="color: red">
                <?php echo $_SESSION['error']; ?> <!-- Hiển thị thông báo lỗi nếu có -->
            </span>
            <?php unset($_SESSION['error']) ?> <!-- Xóa session 'error' sau khi hiển thị nó -->
        <?php } ?>

        <!-- Kiểm tra xem session 'error' có tồn tại không -->
        <?php if (isset($_SESSION['success'])) { ?>
            <span style="color: green">
                <?php echo $_SESSION['success']; ?> <!-- Hiển thị thông báo lỗi nếu có -->
            </span>
            <?php unset($_SESSION['success']) ?> <!-- Xóa session 'error' sau khi hiển thị nó -->
        <?php } ?>

        <!-- Biểu mẫu đăng nhập với phương thức POST -->
        <form id="login-form" action="verify_login.php" method="post">
            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit" class="register-button">Đăng nhập</button>
        </form>

        <br />
        <a href="register.php">Tạo tài khoản mới</a>

    </div>
</body>

</html>