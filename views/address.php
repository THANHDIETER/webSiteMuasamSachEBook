<!-- address.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Địa chỉ giao hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Thông tin địa chỉ giao hàng</h2>

        <form action="?act=address" method="POST">
            <div class="mb-3">
                <label for="receiver" class="form-label">Tên người nhận</label>
                <input type="text" class="form-control" id="receiver" name="receiver" required>
            </div>
            <div class="mb-3">
                <label for="delivery_address" class="form-label">Địa chỉ giao hàng</label>
                <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật địa chỉ</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
