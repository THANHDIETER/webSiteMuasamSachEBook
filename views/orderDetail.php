<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        /* Tùy chỉnh bảng hiển thị chi tiết đơn hàng */
        table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead {
            background-color: #f8f9fa;
        }

        table thead th {
            text-align: center;
        }

        table tbody td {
            vertical-align: middle;
        }

        img {
            border-radius: 8px;
        }

        /* Tùy chỉnh tiêu đề */
        h3 {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            color: #343a40;
        }

        h5 {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 40px;
            color: #212529;
        }

        /* Khoảng cách giữa footer và nội dung */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php require_once 'components/header.php'; ?>

    <main class="container my-5">
        <h3>Chi tiết đơn hàng #<?= $orderDetail[0]['id'] ?></h3>
        <table class="table table-bordered table-hover mt-4">
            <thead class="table-light">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetail as $item): ?>
                    <tr>
                        <td class="d-flex align-items-center">
                            <img src="./assets/images/prod/books/<?= $item['img'] ?>" alt="<?= $item['name'] ?>" style="width: 50px; margin-right: 10px;">
                            <?= $item['name'] ?>
                        </td>
                        <td class="text-end"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                        <td class="text-center"><?= $item['quantity'] ?></td>
                        <td class="text-end"><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?>đ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h5>Tổng tiền: <?= number_format($orderDetail[0]['total_amount'], 0, ',', '.') ?>đ</h5>
        
        <!-- Nút quay lại -->
        <div class="text-end mt-4">
            <a href="index.php?act=order" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Quay lại
            </a>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once 'components/footer.php'; ?>
</body>
</html>
