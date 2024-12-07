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
        <h2 class="text-center">Dashboard</h2>

        <div class="row mt-5 g-4 m-5">
    <!-- Đơn hàng -->
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Đơn hàng</h5>
            <p><i class="bi bi-basket-fill text-primary fs-2"></i></p>
            <p><?= $orderCount ?> Đơn hàng mới</p>
            <a href="index.php?act=order" class="btn btn-outline-primary">Quản lý Đơn hàng</a>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Đơn hàng đang giao</h5>
            <p><i class="bi bi-basket-fill text-primary fs-2"></i></p>
            <p><?= $orderCountNow ?> Đang giao</p>
            <a href="index.php?act=order" class="btn btn-outline-primary">Quản lý Đơn hàng</a>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Đơn hàng đã hủy</h5>
            <p><i class="bi bi-basket-fill text-primary fs-2"></i></p>
            <p><?= $orderCountDelete ?> đơn đã hủy </p>
            <a href="index.php?act=order" class="btn btn-outline-primary">Quản lý Đơn hàng</a>
        </div>
    </div>

    <!-- Sản phẩm -->
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Sản phẩm</h5>
            <p><i class="bi bi-book text-success fs-2"></i></p>
            <p><?= $productCount ?> Sản phẩm</p>
            <a href="index.php?act=listproduct" class="btn btn-outline-success">Quản lý Sản phẩm</a>
        </div>
    </div>

    <!-- Người dùng -->
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Người dùng</h5>
            <p><i class="bi bi-people text-info fs-2"></i></p>
            <p><?= $userCount ?> Người dùng</p>
            <a href="index.php?act=listUsers" class="btn btn-outline-info">Quản lý Người dùng</a>
        </div>
    </div>

    <!-- Doanh thu -->
    <div class="col-md-4 col-sm-6">
        <div class="card dashboard-card text-center shadow-sm p-4">
            <h5>Doanh thu</h5>
            <p><i class="bi bi-currency-dollar text-warning fs-2"></i></p>
            <p><?= number_format($revenue, 0, ',', '.') ?> VND</p>
            <a href="index.php?act=report" class="btn btn-outline-warning">Xem Báo cáo</a>
        </div>
    </div>
</div>
 
    </div>
</body>
</html>
