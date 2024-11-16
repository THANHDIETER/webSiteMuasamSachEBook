<?php
// Kiểm tra dữ liệu được gửi đến
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra thông tin đăng nhập (ví dụ)
    if ($username == "admin" && $password == "1") {
        echo "Đăng nhập thành công!";
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}
?>