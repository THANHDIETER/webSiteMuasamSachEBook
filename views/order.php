<?php if (empty($orders)): ?>
    <p class="text-center">Bạn chưa có đơn hàng nào.</p>
<?php else: ?>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $key => $order): ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= htmlspecialchars($order['id']) ?></td> <!-- Changed to order ID -->
                    <td><?= htmlspecialchars($order['order_date']) ?></td> <!-- Corrected to order_date -->
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td> <!-- Corrected to total_amount -->
                    <td>
                        <a href="?act=orderDetails&order_id=<?= $order['id'] ?>" class="btn btn-primary btn-sm">Xem chi tiết</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
