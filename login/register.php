<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="login-container">
        <h1>Đăng ký</h1>

        <!-- Kiểm tra xem session 'error' có tồn tại không -->
        <?php if (isset($_SESSION['error'])) { ?>
            <span style="color: red">
                <?php echo $_SESSION['error']; ?> <!-- Hiển thị thông báo lỗi nếu có -->
            </span>
            <?php unset($_SESSION['error']) ?> <!-- Xóa session 'error' sau khi hiển thị nó -->
        <?php } ?>

        <!-- Biểu mẫu đăng ký với phương thức POST -->
        <form id="register-form" action="process_registration.php" method="post">
            <input type="text" id="new-username" name="new-username" placeholder="Tên đăng nhập" required>
            <input type="password" id="new-password" name="new-password" placeholder="Mật khẩu" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu"
                required>
            <button type="submit">Đăng ký</button>
        </form>

    </div>
</body>

</html>