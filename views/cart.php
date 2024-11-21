<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="styte/css/styte.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once './components/header.php'; ?>
    <hr>
    <div class="container">
    <h4>Giỏ Hàng</h4>
    <hr>
    <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
            <div class="row mb-3">
                <div class="col-2">
                    <img src="./assets/images/prod/books/<?= $item['img'] ?>" style="width: 100px; height: 150px;" alt="<?= $item['name'] ?>">
                </div>
                <div class="col-6">
                    <a href="?act=detail&id=<?= $item['id'] ?>"><?= $item['name'] ?></a>
                    <p>Số lượng: <?= $item['quantity'] ?></p>
                    <a href="?act=removeFromCart&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </div>
                <div class="col-2">
                    <?= number_format($item['price'], 0, ',', '.') ?>đ
                </div>
            </div>
        <?php endforeach; ?>
        <div class="text-end">
            <h5>Tổng cộng: <?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)), 0, ',', '.') ?>đ</h5>
            <a href="checkout.php" class="btn btn-success">Tiến Hành Đặt Hàng</a>
        </div>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>
</div>

    <?php require_once './components/footer.php'; ?>
</body>
</html>
