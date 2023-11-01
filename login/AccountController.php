<?php
class AccountController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function authenticate($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true; // Tài khoản hợp lệ
        } else {
            return false; // Tài khoản không hợp lệ
        }
    }

    public function isUsernameTaken($username)
    {
        // Kiểm tra xem tài khoản có tồn tại trong cơ sở dữ liệu hay không
        $query = "SELECT * FROM account WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function saveToDatabase($username, $password)
    {
        // Thực hiện lưu tài khoản vào cơ sở dữ liệu
        // Sử dụng $conn (kết nối cơ sở dữ liệu) để thực hiện câu lệnh SQL tương ứng
        $query = "INSERT INTO account (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        return $stmt->execute();
    }
}
?>