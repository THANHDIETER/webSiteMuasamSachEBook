<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-control {
            margin-bottom: 20px;
        }

        .text-center {
            margin-top: 10px;
        }

        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Quên Mật khẩu</h1>
    <form method="POST" action="?act=forgotPassword">
        <div class="mb-3">
            <label for="email" class="form-label">Nhập email của bạn:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi liên kết reset mật khẩu</button>
    </form>
    <div class="text-center">
        <a href="?act=login">Quay lại trang đăng nhập</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
