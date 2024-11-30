<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="styte/css/styte.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .quantity-wrapper {
            display: flex;
            align-items: center;
        }

        .quantity-wrapper button {
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
            padding: 0;
        }

        .quantity-wrapper input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
            margin: 0 5px;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>
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
            <div class="row mb-3 cart-item">
                <div class="col-2">
                    <a href="?act=detail&id=<?= $item['product_id'] ?>">
                        <img src="./assets/images/prod/books/<?= $item['img'] ?>" style="width: 100px; height: 150px;" alt="<?= $item['name'] ?>">
                    </a>
                </div>
                <div class="col-6">
                    <a href="?act=detail&id=<?= $item['product_id'] ?>">
                        <p><?= $item['name'] ?></p>
                    </a>
                    <div class="quantity-wrapper">
                        <button type="button" class="decrease" data-id="<?= $item['id'] ?>">-</button>
                        <input type="number" name="quantities[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                        <button type="button" class="increase" data-id="<?= $item['id'] ?>">+</button>
                    </div>
                </div>
                <div class="col-2">
                    <span class="item-price" data-price="<?= $item['price'] ?>"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                </div>
                <div class="col-2 text-end">
                    <a href="?act=remove_from_cart&id=<?= $item['product_id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
        <div class="text-end">
            <h5 class="total-price">Tổng cộng: <?= number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)), 0, ',', '.') ?>đ</h5>
            <a href="?act=checkout" class="btn btn-success">Tiến Hành Đặt Hàng</a>
        </div>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>
</form>

    </div>
    <script>
       document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.parentElement.querySelector('input[type="number"]');
        input.value = parseInt(input.value) + 1;
        input.dispatchEvent(new Event('change')); // Đảm bảo thay đổi giá trị được gửi đi
        updateTotalPrice(); // Cập nhật lại tổng tiền
    });
});

document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', () => {
        const input = button.parentElement.querySelector('input[type="number"]');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            input.dispatchEvent(new Event('change')); // Đảm bảo thay đổi giá trị được gửi đi
            updateTotalPrice(); // Cập nhật lại tổng tiền
        }
    });
});

// Cập nhật lại tổng tiền sau mỗi thay đổi
function updateTotalPrice() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const quantity = parseInt(item.querySelector('input[type="number"]').value);
        const price = parseFloat(item.querySelector('.item-price').dataset.price);
        total += quantity * price;
    });

    // Cập nhật tổng tiền
    document.querySelector('.total-price').textContent = 'Tổng cộng: ' + total.toLocaleString() + 'đ';
}

    </script>
</div>

    <?php require_once './components/footer.php'; ?>
</body>
</html>
