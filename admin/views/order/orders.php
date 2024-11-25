<table>
    <thead>
        <tr>
            <th>Mã đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['name']) ?></td>
                <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td>
                    <?php if ($order['status'] === 'Chờ xác nhận'): ?>
                        <a href="?act=confirmOrder&order_id=<?= $order['id'] ?>">Xác nhận</a>
                    <?php else: ?>
                        <span>Đã xử lý</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
