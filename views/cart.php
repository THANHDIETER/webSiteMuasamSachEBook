<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
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
            text-align: center;
            cursor: pointer;
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
    <div class="container">
        <h4>Giỏ Hàng</h4>
        <hr>
        <form action="index.php?act=updateQuantity" method="POST">
    <?php if (!empty($cartItems)): ?>
        <?php foreach ($cartItems as $item): ?>
            <div class="row mb-3 cart-item">
                <div class="col-2">
                    <a href="?act=detail&id=<?= $item['product_id'] ?>">
                        <img src="./assets/images/prod/books/<?= $item['img'] ?>" style="width: 120px; height: 120px;" alt="<?= $item['name'] ?>">
                    </a>
                </div>
                <div class="col-6">
                    <a href="?act=detail&id=<?= $item['product_id'] ?>">
                        <p><?= $item['name'] ?> (<?= $item['format'] ?> - <?= $item['language'] ?> - <?= $item['edition'] ?>)</p>
                    </a>
                    <div class="quantity-wrapper">
                        <button type="button" class="decrease" data-id="<?= $item['id'] ?>">-</button>
                        <input type="number" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" min="1">
                        <button type="button" class="increase" data-id="<?= $item['id'] ?>">+</button>
                    </div>
                </div>
                <div class="col-2">
                    <span class="item-price" data-price="<?=$sale = ($item['price']-($item['price']/100)*$item['sale'])+$item['variant_price']?>"> <?= number_format($sale, 0, ',', '.') ?>đ </span>
                </div>
                <div class="col-2 text-end">
                    <a href="?act=remove_from_cart&product_id=<?= $item['product_id'] ?>&variant_id=<?= $item['variant_id'] ?>" 
                    class="btn btn-danger btn-sm">Xóa</a>
                </div>  

            </div>
        <?php endforeach; ?>

        <hr>
        <div class="text-end">
        <h5 class="total-price">
    Tổng cộng: 
    <?php 
    $totalPrice = array_sum(array_map(function($item) {
        $finalPrice = ($item['price'] - ($item['price'] * $item['sale'] / 100)) + $item['variant_price'];
        return $finalPrice * $item['quantity'];
    }, $cartItems));
    echo number_format($totalPrice, 0, ',', '.') . "đ";
    ?>
</h5>
            <a href="?act=checkout" class="btn btn-success">Tiến Hành Đặt Hàng</a>
        </div>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>
</form>

    </div>

    <script>
    document.querySelectorAll('.increase').forEach(button => {
    button.addEventListener('click', function () {
        const input = button.parentElement.querySelector('input[type="number"]');
        input.value = parseInt(input.value) + 1;
        updateQuantityAJAX(input);
    });
});

document.querySelectorAll('.decrease').forEach(button => {
    button.addEventListener('click', function () {
        const input = button.parentElement.querySelector('input[type="number"]');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateQuantityAJAX(input);
        }
    });
});


function updateQuantityAJAX(input) {
    const cartItemId = input.name.match(/\d+/)[0]; // Lấy ID của sản phẩm trong giỏ hàng
    const quantity = input.value;

    // Gửi yêu cầu AJAX để cập nhật số lượng
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php?act=updateQuantity", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Cập nhật giá và tổng tiền
                    updateTotalPrice();
                } else {
                    alert('Có lỗi xảy ra khi cập nhật số lượng.');
                    // Reset số lượng về giá trị cũ nếu lỗi xảy ra
                    input.value = response.old_quantity;
                }
            }
        };
        xhr.send("quantities[" + cartItemId + "]=" + quantity);
    }


    function updateTotalPrice() {
    let totalPrice = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const price = parseFloat(item.querySelector('.item-price').getAttribute('data-price'));
        const quantity = parseInt(item.querySelector('input[type="number"]').value);
        totalPrice += price * quantity;
    });
    document.querySelector('.total-price').textContent = "Tổng cộng: " + totalPrice.toLocaleString() + "đ";
}

</script>



    <?php require_once './components/footer.php'; ?>
</body>
</html>
