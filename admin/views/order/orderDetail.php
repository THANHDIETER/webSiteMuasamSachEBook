<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-top: 30px;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 1100px;
        }

        h2 {
            color: #007bff;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-info h4, h4 {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .order-info ul {
            list-style-type: none;
            padding-left: 0;
            font-size: 16px;
            line-height: 1.8;
            color: #495057;
        }

        .order-info li {
            margin-bottom: 10px;
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }

        .table td {
            font-size: 16px;
            text-align: center;
            padding: 12px;
            color: #495057;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table td {
            font-size: 14px;
        }

        .table th, .table td {
            padding: 14px;
        }

        .btn-info {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-info:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .order-summary {
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-summary span {
            color: #28a745;
        }

        .btn-back {
            background-color: #007bff;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-back:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        .order-summary span a {
            text-decoration: none;
            color: #007bff;
        }

        .order-summary span a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php require_once "components/header.php"; ?>
    <div class="main-content">
        <div class="container mt-5">
            <h2>Chi Tiết Đơn Hàng #<?php echo $order_details['id']; ?></h2>
            <p><strong>Trạng thái:</strong> <?php echo $order_details['status']; ?></p>
            <p><strong>Ngày đặt hàng:</strong> <?php echo $order_details['order_date']; ?></p>

            <div class="order-info">
                <h4>Thông tin người nhận:</h4>
                <ul>
                    <li><strong>Họ và tên:</strong> <?php echo $order_details['name']; ?></li>
                    <li><strong>Điện thoại:</strong> 0<?php echo $order_details['phone']; ?></li>
                    <li><strong>Địa chỉ giao hàng:</strong> <?php echo $order_details['address']; ?></li>
                    <li><strong>Email:</strong> <?php echo $order_details['email']; ?></li>
                </ul>
            </div>

            <h4>Danh Sách Sản Phẩm</h4>
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Sản phẩm</th>
            <th>Biến thể</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Tổng giá</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($order_details['items'] as $item): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td>
                    Format: <?php echo htmlspecialchars($item['format']); ?><br>
                    Language: <?php echo htmlspecialchars($item['language']); ?><br>
                    Edition: <?php echo htmlspecialchars($item['edition']); ?>
                </td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($item['unit_price'], 0, ',', '.'); ?> VND</td>
                <td><?php echo number_format($item['unit_price'] * $item['quantity'], 0, ',', '.'); ?> VND</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


            <div class="order-summary" style="display: flex; justify-content: space-between;">
                <span>Tổng tiền: <?php echo number_format($order_details['total_amount'], 0, ',', '.'); ?> VND</span>
                <span><a class="btn-back" href="?act=order">Quay lại</a></span>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for interactivity like modals, tooltips, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
