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
        background-color: #f4f6f9;
        font-family: 'Arial', sans-serif;
    }
    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
    }
    h2, h3, h4 {
        color: #333;
        font-weight: bold;
    }
    .table thead {
        background-color: #007bff;
        color: #fff;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
        transform: translateY(-3px);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
    .btn-primary:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }
    .text-danger {
        font-weight: bold;
        font-size: 1.2em;
    }
    table {
        border-radius: 5px;
        overflow: hidden;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table tbody tr:hover {
        background-color: #f1f3f5;
    }
    .text-end {
        text-align: right;
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
        <?php if (empty($cart_items)): ?>
            <p>Giỏ hàng của bạn hiện tại đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.</p>
        <?php else: ?>
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
                        <td>
                            <?php echo htmlspecialchars($item['product_name']); ?>
                            <br>
                            <small>
                                <strong>Biến thể:</strong> 
                                <?php echo htmlspecialchars($item['format']); ?> - 
                                <?php echo htmlspecialchars($item['language']); ?> - 
                                <?php echo htmlspecialchars($item['edition']); ?>
                            </small>
                        </td>
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
    <!-- Thanh toán qua COD -->
    <form action="?act=processCheckout" method="POST">
        <input type="hidden" name="payment_method" value="COD">
        <button type="submit" class="btn btn-primary">Thanh toán khi nhận hàng (COD)</button>
    </form>
    <br>

        <!-- Thanh toán qua VNPAY -->
    <form action="vnpay_payment.php" method="POST">
        <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <input type="hidden" name="payment_method" value="VNPAY">
        <button type="submit" class="btn btn-primary">Thanh toán qua VNPAY</button>
    </form>

    </div>


        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
