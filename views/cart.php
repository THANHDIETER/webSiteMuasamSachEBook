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
    <form action="index.php?act=updateQuantity" method="POST">
    <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
            <div class="row mb-3">
                <div class="col-2">
                <a class="bg-white nav-link" href="?act=detail&id=<?php echo $item['product_id'] ?>">
                    <img src="./assets/images/prod/books/<?= $item['img'] ?>" style="width: 100px; height: 150px;" alt="<?= $item['name'] ?>">
                    </a>
                </div>
                <div class="col-6">
                <a class="bg-white nav-link" href="?act=detail&id=<?php echo $item['product_id'] ?>">
                    <p><?= $item['name'] ?></p>
                    </a>
                    <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control w-25">
                </div>
                <div class="col-2">
                    <?= number_format($item['price'], 0, ',', '.') ?>đ
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
        <div class="text-end">
            <h5>Tổng cộng: <?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)), 0, ',', '.') ?>đ</h5>
           <hr> <a href="?act=checkout" class="btn btn-success">Tiến Hành Đặt Hàng</a>
        </div>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>
</form>
     <br>
</div>
<script>
    document.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('change', () => {
            input.form.submit();
        });
    });
</script>

    <?php require_once './components/footer.php'; ?>
</body>
</html>
