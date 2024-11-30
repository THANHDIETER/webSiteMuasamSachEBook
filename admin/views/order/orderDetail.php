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
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-left: 300px;
        }

        h2 {
            color: #007bff;
        }

        .table th {
            background-color: #007bff;
            color: #ffffff;
        }

        .table td {
            font-size: 14px;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }

        .table th, .table td {
            padding: 12px;
        }

        .btn-info {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-info:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .order-info ul {
            list-style-type: none;
            padding-left: 0;
        }

        .order-info li {
            margin-bottom: 8px;
        }

        .order-summary {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .order-summary span {
            color: #28a745;
        }
    </style>
</head>
<body>
<?php require_once "components/header.php"; ?>
    <div class=" container mt-5">
        <h2>Chi Tiết Đơn Hàng #<?php echo $order_details['id']; ?></h2>
        <p><strong>Trạng thái:</strong> <?php echo $order_details['status']; ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?php echo $order_details['order_date']; ?></p>
        
        <div class="order-info">
            <h4>Thông tin người nhận:</h4>
            <ul>
                <li><strong>Họ và tên:</strong> <?php echo $order_details['name']; ?></li>
                <li><strong>Điện thoại:</strong> <?php echo $order_details['phone']; ?></li>
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
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng giá</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($order_details['items'] as $item): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $item['product_id']; ?></td> <!-- Hoặc lấy tên sản phẩm từ bảng products -->
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                        <td><?php echo number_format($item['total_price'], 0, ',', '.'); ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="order-summary " style="display:flex;justify-content: space-between; ">
            <span>Tổng tiền: <?php echo number_format($order_details['total_amount'], 0, ',', '.'); ?> VND</span>
            <span><a href="?act=order">Quay lại</a></span>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for interactivity like modals, tooltips, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
