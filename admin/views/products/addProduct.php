<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .main-content {
            margin-top: 50px;
        }

        h1 {
            color: #333;
        }

        form input,
        form select,
        form textarea {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php require_once "components/header.php"; ?>

    <div style="margin-left: 250px;">
        <div class="container my-2">
            <div class="card p-5">
            <h1 class="fw-bold text-center">Thêm sản phẩm</h1>
<form action="" enctype="multipart/form-data" method="POST" id="productForm">
    <div class="row">
        <div class="col-6">
            <label for="name">Tên sách</label>
            <input class="form-control" type="text" id="name" name="name" >
        </div>
        <div class="col-6">
            <label for="category_id">Danh mục</label>
            <select class="form-select" id="category_id" name="category_id" >
                <option value="">Chọn danh mục</option>
                <?php foreach ($listDanhMuc as $key): ?>
                    <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6">
            <label for="publishing_house_id">Nhà xuất bản</label>
            <select class="form-select" id="publishing_house_id" name="publishing_house_id" >
                <option value="">Chọn nhà xuất bản</option>
                <?php foreach ($listNhaXuatBan as $key): ?>
                    <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6">
            <label for="author_id">Tác giả</label>
            <select class="form-select" id="author_id" name="author_id" >
                <option value="">Chọn tác giả</option>
                <?php foreach ($listTacGia as $key): ?>
                    <option value="<?= $key['id'] ?>"><?= $key['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6">
            <label for="img">Hình ảnh</label>
            <input class="form-control" type="file" id="img" name="img" accept="image/*" >
        </div>
        <div class="col-6">
            <label for="price">Giá</label>
            <input class="form-control" type="number" id="price" min="0" value="0" name="price">
        </div>
        <div class="col-6">
            <label for="sale">Sale (%)</label>
            <input class="form-control" type="number" id="sale" name="sale" min="0" max="100">
        </div>
        <div class="col-6">
            <label for="quantity">Số lượng</label>
            <input class="form-control" type="number" id="quantity" name="quantity" min="1" >
        </div>
        <div class="col-12">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
    </div>
    <button type="submit" name="btn_insert" class="btn btn-primary">Thêm sản phẩm</button>
</form>
        </div>
    </div>
</body>
<script>
    document.getElementById('productForm').addEventListener('submit', function(event) {
        const name = document.getElementById('name').value.trim();
        const category = document.getElementById('category_id').value;
        const publishingHouse = document.getElementById('publishing_house_id').value;
        const author = document.getElementById('author_id').value;
        const img = document.getElementById('img').value;
        const price = document.getElementById('price').value;
        const sale = document.getElementById('sale').value;
        const quantity = document.getElementById('quantity').value;
        if (name === '') {
            alert('Vui lòng nhập tên sách!');
            event.preventDefault();
            return;
        }
        if (category === '') {
            alert('Vui lòng chọn danh mục!');
            event.preventDefault();
            return;
        }
        if (publishingHouse === '') {
            alert('Vui lòng chọn nhà xuất bản!');
            event.preventDefault();
            return;
        }
        if (author === '') {
            alert('Vui lòng chọn tác giả!');
            event.preventDefault();
            return;
        }
        if (img === '') {
            alert('Vui lòng chọn hình ảnh!');
            event.preventDefault();
            return;
        }
        if (price <= 0) {
            alert('Giá phải lớn hơn 0!');
            event.preventDefault();
            return;
        }
        if (sale < 0 || sale > 100) {
            alert('Sale phải nằm trong khoảng từ 0 đến 100%!');
            event.preventDefault();
            return;
        }
        if (quantity <= 0) {
            alert('Số lượng phải lớn hơn 0!');
            event.preventDefault();
            return;
        }
    });
</script>
</html>