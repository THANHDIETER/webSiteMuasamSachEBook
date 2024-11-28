<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #e9ecef;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        h3 {
            color: #343a40;
            font-weight: bold;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table thead {
            background-color: #212529;
            color: white;
        }
        .badge {
            padding: 0.5em 1em;
            font-size: 90%;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .text-danger, .text-success, .text-primary {
            font-weight: bold;
        }
        .alert-info {
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
<?php require_once 'components/header.php'; ?>

<div class="container">
    <h3 class="text-center mb-4">Danh sách đơn hàng</h3>
    <?php if (!empty($orders)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Loại thanh toán</th>
                    <th>Chi tiết</th>
                    <th>Hủy</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= date('d/m/Y', strtotime($order['order_date'])) ?></td>
                        <td class="text-end"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                        <td>
                            <span class="badge 
                                <?= $order['status'] == 'Chờ xác nhận' ? 'bg-warning text-dark' : 
                                ($order['status'] == 'Đã xác nhận' ? 'bg-success' : 
                                ($order['status'] == 'Đã hủy' ? 'bg-danger' : 
                                ($order['status'] == 'đang giao hàng' ? 'bg-primary' : 'bg-secondary'))) ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                        <td><?= $order['payment_type'] ?></td>
                        <td>
                            <a href="index.php?act=orderDetail&id=<?= $order['id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> Xem chi tiết
                            </a>
                        </td>
                        <td>
                            <?php if ($order['status'] == 'Chờ xác nhận'): ?>
                                <a href="index.php?act=cancelOrder&id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?');">
                                    <i class="fas fa-times-circle"></i> Hủy đơn
                                </a>
                            <?php elseif ($order['status'] == 'Đã hủy'): ?>
                                <span class="text-danger">Đơn hàng đã bị hủy</span>
                            <?php elseif ($order['status'] == 'Đã xác nhận'): ?>
                                <span class="text-success">Đơn hàng đã giao</span>
                            <?php elseif ($order['status'] == 'đang giao hàng'): ?>
                                <span class="text-primary">Đang giao hàng</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Không có đơn hàng nào.</div>
    <?php endif; ?>
</div>

<?php require_once 'components/footer.php'; ?>
</body>
</html>
