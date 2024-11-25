<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view orders</title>
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .badge-success {
            background-color: #28a745; 
            color: #fff; 
        }
        .badge-warning {
            background-color: #ffc107;
            color: #000; 
        }
    </style>
</head>
<body>
<?php  require_once 'components/header.php'; ?>
<?php if (!empty($orders)): ?>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Danh sách đơn hàng</h3>
        
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                    <th>Hủy</th> <!-- Cột Hủy đơn hàng -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= date('d/m/Y', strtotime($order['order_date'])) ?></td>
                        <td><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                        <td>
                            <span class="badge 
                                <?= $order['status'] == 'Chờ xác nhận' ? 'badge-warning' : 
                                ($order['status'] == 'Đã xác nhận' ? 'badge-success' : 
                                ($order['status'] == 'Đã huỷ' ? 'badge-danger' : 'badge-secondary')) ?>">
                                <?= $order['status'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="index.php?act=orderDetail&id=<?= $order['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                        </td>
                        <td>
                            <?php if ($order['status'] == 'Chờ xác nhận'): ?>
                                <a href="index.php?act=cancelOrder&id=<?= $order['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng?');">Hủy đơn</a>
                            <?php elseif ($order['status'] == 'Đã huỷ'): ?>
                                <span class="text-danger">Đơn hàng đã bị hủy</span>
                            <?php elseif ($order['status'] == 'Đã xác nhận'): ?>
                                <span class="text-success">Đơn hàng đã giao</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <p class="alert alert-info">Không có đơn hàng nào.</p>
    </div>
<?php endif; ?>
<?php  require_once 'components/footer.php'; ?>
</body>
</html>
