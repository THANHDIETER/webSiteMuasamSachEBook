<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="main-content">
        <div class="container">
            <h1 class="fw-bold text-center mt-4">Thêm Sản Phẩm</h1>
            <form action="?act=insert" enctype="multipart/form-data" method="POST" class="mt-4">
                <!-- Tên sản phẩm -->
                <div class="form-group">
                    <label for="name">Tên sách</label>
                    <input class="form-control" type="text" id="name" name="name" required>
                </div><br>

                <!-- Danh mục -->
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="" selected disabled>Chọn danh mục</option>
                        <?php foreach ($listDanhMuc as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Nhà xuất bản -->
                <div class="form-group">
                    <label for="publishing_house_id">Nhà xuất bản</label>
                    <select class="form-control" id="publishing_house_id" name="publishing_house_id" required>
                        <option value="" selected disabled>Chọn nhà xuất bản</option>
                        <?php foreach ($listNhaXuatBan as $publisher): ?>
                            <option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Tác giả -->
                <div class="form-group">
                    <label for="author_id">Tác giả</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <option value="" selected disabled>Chọn tác giả</option>
                        <?php foreach ($listTacGia as $author): ?>
                            <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Ảnh sản phẩm -->
                <div class="form-group">
                    <label for="img">Hình ảnh</label>
                    <input class="form-control" type="file" id="img" name="img" required>
                </div><br>

                <!-- Giá sản phẩm -->
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input class="form-control" type="number" id="price" name="price" step="0.01" required>
                </div><br>

                <!-- Số lượng -->
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input class="form-control" type="number" id="quantity" name="quantity" required>
                </div><br>

                <!-- Mô tả -->
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div><br>

                <!-- Nút Submit -->
                <div class="form-group text-center">
                    <button type="submit" name="btn_insert" class="btn btn-primary" style="width: 200px;">Thêm Sản
                        Phẩm</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>