<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo Doanh Thu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .summary {
            font-size: 18px;
            font-weight: 600;
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .summary p {
            margin: 10px 0;
            color: #495057;
        }
        .btn-primary {
            display: block;
            width: 200px;
            margin: 30px auto 0;
            padding: 10px 0;
            font-size: 16px;
            border-radius: 50px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #003f7f 100%);
        }
    </style>
</head>
<body>
    <?php require_once "components/header.php"; ?>
    <div class="container main-content">
        <h2>Báo Cáo Doanh Thu</h2>
        <div class="summary">
            <p><strong>Tổng số đơn hàng:</strong> <?php echo number_format($report_data['total_orders']); ?></p>
            <p><strong>Tổng doanh thu:</strong> <?php echo number_format($report_data['total_revenue'], 0, ',', '.'); ?> VND</p>
            <p><strong>Tổng số sản phẩm đã bán:</strong> <?php echo number_format($report_data['total_products_sold']); ?></p>
        </div>
        <a href="?act=dashboard" class="btn btn-primary">Quay lại Trang Chủ</a>
    </div>
</body>
</html>
