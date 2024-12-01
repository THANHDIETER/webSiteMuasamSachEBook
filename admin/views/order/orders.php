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
        }

        .order-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .btn.confirm-btn {
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .btn.confirm-btn:hover {
            background-color: #218838;
        }

        .btn.ship-btn {
            background-color: #17a2b8;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .btn.ship-btn:hover {
            background-color: #138496;
        }

        .status-text {
            font-weight: bold;
            color:#17a2b8;
        }

        .paid-status {
            color: #28a745;
        }

        .unpaid-status {
            color: #dc3545;
        }

        .badge {
            font-weight: bold;
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
        <h1 class="bg-primary text-white py-2 rounded-top mb-3 mt-4">Danh sách Đơn hàng</h1>
    </header>

    <div class="container">
        <table class="table table-bordered table-striped order-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Thanh toán</th>
                    <th>Trạng thái vận chuyển</th>
                    <th>Hành động</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
    <tr>
        <td><?= $order['id'] ?></td>
        <td><?= htmlspecialchars($order['name']) ?></td>
        <td><?= htmlspecialchars($order['address']) ?></td>
        <td><?= htmlspecialchars($order['phone']) ?></td>
        <td><?= htmlspecialchars($order['email']) ?></td>
        <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td>
        <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
        <td>
            <span class="status-text <?= $order['payment_type'] == 'Đã thanh toán' ? 'paid-status' : 'unpaid-status' ?>">
                <?= htmlspecialchars($order['payment_type']) ?>
            </span>
        </td>
        <td>
            <span class="badge <?= 
                $order['status'] == 'đang giao hàng' ? 'badge-primary' : 
                ($order['status'] == 'Đã xác nhận' ? 'badge-warning' : 
                ($order['status'] == 'Đã hủy' ? 'badge-danger' : 
                ($order['status'] == 'Giao hàng thành công' ? 'badge-success' : 'badge-secondary'))) ?>">
                <?= htmlspecialchars($order['status']) ?>
            </span>
        </td>
        <td>
            <?php if ($order['status'] == 'Chờ xác nhận'): ?>
                <a href="?act=confirmOrder&order_id=<?= $order['id'] ?>" class="btn btn-primary btn-sm">Giao hàng</a>
                <a href="?act=cancelOrder&order_id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">Hủy</a>
            <?php elseif ($order['status'] == 'đang giao hàng'): ?>
                <a href="?act=completeOrder&order_id=<?= $order['id'] ?>" class="btn btn-success btn-sm">Xác nhận</a>
                <a href="?act=cancelOrder&order_id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">Bom hàng</a>
            <?php elseif ($order['status'] == 'Đã hủy'): ?>
                <span class="badge badge-danger">Đã hủy</span>
            <?php elseif ($order['status'] == 'Đã xác nhận'): ?>
                <span class="badge badge-success">Giao hàng thành công</span>
            <?php endif; ?>
        </td>
        <td>
            <a href="?act=orderDetail&order_id=<?= $order['id'] ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
        </td>
    </tr>
<?php endforeach; ?>


            </tbody>
        </table>
    </div>
</div>

<!-- Liên kết tới Bootstrap JS và jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
