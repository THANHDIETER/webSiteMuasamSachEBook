<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Biến thể</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: white;
            width: 90%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        select, input {
            border-radius: 5px;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
<?php require_once 'components/header.php'; ?>

<div class="container main-content mt-5">
    <h1 class="mb-4">Chỉnh sửa Biến thể</h1>
    <form method="POST" action="?act=updateVariant&variant_id=<?= $variant['id'] ?>" novalidate>
        <div class="mb-3">
            <label for="book_id" class="form-label">Chọn Sách</label>
            <select class="form-control" id="book_id" name="book_id" required>
                <option value="">-- Chọn Sách --</option>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book['id'] ?>" <?= $variant['book_id'] == $book['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($book['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                Vui lòng chọn sách.
            </div>
        </div>
        <div class="mb-3">
            <label for="format" class="form-label">Định dạng</label>
            <input type="text" class="form-control" id="format" name="format" value="<?= htmlspecialchars($variant['format']) ?>" required>
            <div class="invalid-feedback">
                Vui lòng nhập định dạng.
            </div>
        </div>
        <div class="mb-3">
            <label for="language" class="form-label">Ngôn ngữ</label>
            <input type="text" class="form-control" id="language" name="language" value="<?= htmlspecialchars($variant['language']) ?>" required>
            <div class="invalid-feedback">
                Vui lòng nhập ngôn ngữ.
            </div>
        </div>
        <div class="mb-3">
            <label for="edition" class="form-label">Phiên bản</label>
            <input type="text" class="form-control" id="edition" name="edition" value="<?= htmlspecialchars($variant['edition']) ?>" required>
            <div class="invalid-feedback">
                Vui lòng nhập phiên bản.
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $variant['price'] ?>" min="0" required>
            <div class="invalid-feedback">
                Vui lòng nhập giá hợp lệ.
            </div>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Số lượng</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= $variant['stock'] ?>" min="0" required>
            <div class="invalid-feedback">
                Vui lòng nhập số lượng hợp lệ.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Biến thể</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Validate form trước khi gửi
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>
</body>
</html>
