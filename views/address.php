<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Địa Chỉ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        h3 {
            color: #343a40;
            font-weight: bold;
        }

        label {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <?php require_once './components/header.php'; ?>
    <div class="container">
        <h3 class="mb-4 text-center">Cập Nhật Địa Chỉ Giao Hàng</h3>
        <form action="?act=address" method="POST">
            <div class="mb-3">
                <label for="receiver" class="form-label">Họ và Tên Người Nhận</label>
                <input type="text" class="form-control" id="receiver" name="receiver" 
                       value="<?= $user_address['receiver'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="delivery_address" class="form-label">Địa Chỉ Giao Hàng</label>
                <input type="text" class="form-control" id="delivery_address" name="delivery_address" 
                       value="<?= $user_address['delivery_address'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số Điện Thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" 
                       value="<?= $user_address['phone_number'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="<?= $user_address['email'] ?? '' ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php?act=cart" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Lưu Địa Chỉ</button>
            </div>
        </form>
    </div> <br><br>
    <?php require_once './components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
