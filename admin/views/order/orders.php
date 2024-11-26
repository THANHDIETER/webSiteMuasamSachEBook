<!-- adminOrders.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Đơn hàng</title>
    
    <!-- Liên kết tới Bootstrap 4 CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS tùy chỉnh -->
    <style>
        body {
            background-color: #f4f4f9;
            
        }
        .container {
            margin-top: 30px;
            float: right;
        }

        .order-table {
            margin-top: 20px;
        }

        .order-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .order-table td {
            font-size: 14px;
        }

        .btn.confirm-btn {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .btn.confirm-btn:hover {
            background-color: #218838;
        }

        .btn.disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        .status-text {
            color: #6c757d;
            font-style: italic;
        }

        header h1 {
            font-size: 2rem;
            color: #333;
        }
    </style>
</head>
<body>
<?php require_once "components/header.php"; ?>
<div class="main-content">
    
        <header class="text-center">
        <h1 class="bg-primary text-white py-2 rounded-top mb-3 mt-4 text-center">Danh sách Đơn hàng</h1>
        </header>

        <table class="table table-bordered table-striped order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['name'] ?></td>
                    <td><?= $order['address'] ?></td>
                    <td><?= $order['phone'] ?></td>
                    <td><?= $order['email'] ?></td>
                    <td><?= number_format($order['total_amount']) ?> VND</td>
                    <td>
                        <?php if ($order['status'] == 'Chờ xác nhận'): ?>
                            <a href="?act=confirmOrder&order_id=<?= $order['id'] ?>" class="btn confirm-btn">Xác nhận</a>
                        <?php else: ?>
                            <span class="status-text">Đã xác nhận</span>
                        <?php endif; ?>
                    </td>
                    <td>
                            <a href="?act=orderDetail&order_id=<?php echo $order['id']; ?>" class="btn btn-info">Xem Chi Tiết</a>
                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <!-- Liên kết tới Bootstrap JS và jQuery (dành cho các thành phần Bootstrap sử dụng JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
