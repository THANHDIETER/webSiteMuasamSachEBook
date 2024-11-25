<!-- checkout.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Thông tin thanh toán</h2>
        <div class="mb-4">
            <h4>Địa chỉ giao hàng</h4>
            <?php if ($user_address): ?>
                <p><strong>Tên người nhận:</strong> <?php echo htmlspecialchars($user_address['receiver']); ?></p>
                <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($user_address['delivery_address']); ?></p>
                <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($user_address['phone_number']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user_address['email']); ?></p>
                <!-- Nút sửa địa chỉ -->
                <a href="index.php?act=address" class="btn btn-primary">Sửa địa chỉ</a>
            <?php else: ?>
                <p>Bạn chưa có địa chỉ giao hàng. Vui lòng thêm địa chỉ.</p>
                <!-- Nút thêm địa chỉ -->
                <a href="index.php?act=address" class="btn btn-primary">Thêm địa chỉ</a>
            <?php endif; ?>
        </div>

        <h3 class="mb-3">Sản phẩm trong giỏ hàng:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_price = 0; ?>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo number_format($item['quantity'] * $item['price'], 0, ',', '.'); ?> VND</td>
                    </tr>
                    <?php $total_price += $item['quantity'] * $item['price']; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4 class="text-end">Tổng tiền: <span class="text-danger"><?php echo number_format($total_price, 0, ',', '.'); ?> VND</span></h4>

        <div class="text-end mt-4">
            <form action="?act=processCheckout" method="POST">
                <button type="submit" class="btn btn-primary">Tiến hành đặt hàng</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
