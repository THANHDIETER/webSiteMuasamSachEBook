<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Biến thể mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            padding: 20px;
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
        }
        .box {
            width: 100%;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
<?php require_once 'components/header.php'; ?>

<div class="container main-content">
    <h1>Thêm Biến thể mới</h1>
    <form method="POST" action="?act=createVariant" novalidate>
        <div class="row box">
            <div class="col-6">
                <label for="book_id" class="form-label">Chọn Sách</label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="">-- Chọn Sách --</option>
                    <?php foreach ($books as $book): ?>
                        <option value="<?= $book['id'] ?>"><?= htmlspecialchars($book['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    Vui lòng chọn sách.
                </div>
            </div>
            <div class="col-6">
                <label for="format" class="form-label">Định dạng</label>
                <input type="text" class="form-control" id="format" name="format" placeholder="Nhập định dạng (ví dụ: Bìa cứng)" required>
                <div class="invalid-feedback">
                    Vui lòng nhập định dạng sách.
                </div>
            </div>
            <div class="col-6">
                <label for="language" class="form-label">Ngôn ngữ</label>
                <input type="text" class="form-control" id="language" name="language" placeholder="Nhập ngôn ngữ" required>
                <div class="invalid-feedback">
                    Vui lòng nhập ngôn ngữ.
                </div>
            </div>
            <div class="col-6">
                <label for="edition" class="form-label">Phiên bản</label>
                <input type="text" class="form-control" id="edition" name="edition" placeholder="Nhập phiên bản" required>
                <div class="invalid-feedback">
                    Vui lòng nhập phiên bản.
                </div>
            </div>
            <div class="col-6">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá" min="0" required>
                <div class="invalid-feedback">
                    Vui lòng nhập giá hợp lệ.
                </div>
            </div>
            <div class="col-6">
                <label for="stock" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Nhập số lượng" min="0" required>
                <div class="invalid-feedback">
                    Vui lòng nhập số lượng hợp lệ.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Thêm Biến thể</button>
        </div>
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
