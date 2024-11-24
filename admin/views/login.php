<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Đăng nhập</h3>
                        <button class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-facebook"></i> Đăng nhập bằng tài khoản Facebook
                        </button>
                        <div class="text-center my-2 text-muted">hoặc đăng nhập dùng email</div>
                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" placeholder="Mật khẩu">
                            </div>
                            <button type="submit" class="btn btn-orange w-100">Đăng nhập</button>
                        </form>
                        <div class="text-center mt-3">
                            <span class="text-muted">Chưa có tài khoản? </span>
                            <a href="#" class="text-primary">Đăng ký tại đây</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-orange {
            background-color: #ff5722;
            color: white;
            border: none;
        }
        .btn-orange:hover {
            background-color: #e64a19;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// login.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Placeholder for authentication logic (e.g., checking with a database)
    // In a real-world scenario, you should securely hash passwords and verify them.

    if ($email == "example@example.com" && $password == "123456") {
        echo "Đăng nhập thành công!";
    } else {
        echo "Thông tin đăng nhập không chính xác!";
    }
}
?>