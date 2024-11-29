<?php

if (!isset($_SESSION['id'])) {
    header("Location: index.php?act=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin: 30px auto;
        }
        .dashboard-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php require_once 'components/header.php'; ?>

    <div class="container main-content dashboard-container">
        <h2 class="text-center">Welcome to Your Dashboard</h2>

        <div class="row mt-5 m-5">
            <div class=" col-md-4">
                <div class="card dashboard-card text-center">
                    <h5>Đơn hàng</h5>
                    <p><i class="bi bi-basket-fill"></i> 12 Đơn hàng mới</p>
                    <a href="index.php?act=order" class="btn btn-primary">Quản lý Đơn hàng</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card text-center">
                    <h5>Sản phẩm</h5>
                    <p><i class="bi bi-book"></i> 35 Sản phẩm</p>
                    <a href="index.php?act=product" class="btn btn-primary">Quản lý Sản phẩm</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card text-center">
                    <h5>Người dùng</h5>
                    <p><i class="bi bi-people"></i> 120 Người dùng</p>
                    <a href="index.php?act=user" class="btn btn-primary">Quản lý Người dùng</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card dashboard-card text-center">
                    <h5>Doanh thu</h5>
                    <p><i class="bi bi-currency-dollar"></i> 150,000,000 VND</p>
                    <a href="index.php?act=report" class="btn btn-primary">Xem Báo cáo</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
