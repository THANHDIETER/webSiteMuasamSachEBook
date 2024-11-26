<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once "components/header.php"; ?>

    <div class="main-content">
        <div class="container">
            <h1 class="fw-bold text-center">Cập nhật sản phẩm</h1>
            <form action="" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="<?= $Product['id'] ?>">

                <!-- Tên sách -->
                <div class="form-group">
                    <label for="name">Tên sách</label>
                    <input id="name" class="form-control" value="<?= htmlspecialchars($Product['name']) ?>" type="text" name="name" required>
                </div><br>

                <!-- Danh mục -->
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="0" <?= $Product['category_id'] == 0 ? 'selected' : '' ?>>Chọn danh mục</option>
                        <?php foreach ($listDanhMuc as $key): ?>
                            <option value="<?= $key['id'] ?>" <?= $Product['category_id'] == $key['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($key['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Nhà xuất bản -->
                <div class="form-group">
                    <label for="publishing_house_id">Nhà xuất bản</label>
                    <select class="form-control" id="publishing_house_id" name="publishing_house_id" required>
                        <option value="0" <?= $Product['publishing_house_id'] == 0 ? 'selected' : '' ?>>Chọn nhà xuất bản</option>
                        <?php foreach ($listNhaXuatBan as $key): ?>
                            <option value="<?= $key['id'] ?>" <?= $Product['publishing_house_id'] == $key['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($key['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Tác giả -->
                <div class="form-group">
                    <label for="author_id">Tác giả</label>
                    <select class="form-control" id="author_id" name="author_id" required>
                        <option value="0" <?= $Product['author_id'] == 0 ? 'selected' : '' ?>>Chọn tác giả</option>
                        <?php foreach ($listTacGia as $key): ?>
                            <option value="<?= $key['id'] ?>" <?= $Product['author_id'] == $key['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($key['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div><br>

                <!-- Hình ảnh -->
                <div class="form-group">
                    <label for="img">Hình ảnh</label>
                    <input id="img" class="form-control" type="file" name="img">
                    <?php if (!empty($Product['img'])): ?>
                        <br>
                        <img src="../assets/images/prod/books/<?= htmlspecialchars($Product['img']) ?>" alt="Current Image"
                            style="max-width: 200px;">
                    <?php endif; ?>
                </div><br>

                <!-- Giá -->
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input id="price" class="form-control" type="number" name="price" value="<?= $Product['price'] ?>" required>
                </div><br>

                <!-- Giảm giá -->
                <div class="form-group">
                    <label for="sale">Giảm giá (%)</label>
                    <input id="sale" class="form-control" type="number" name="sale" min="0" max="100" value="<?= $Product['sale'] ?>">
                </div><br>

                <!-- Mô tả -->
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea id="description" class="form-control" name="description" rows="4"><?= htmlspecialchars($Product['description']) ?></textarea>
                </div><br>

                <!-- Số lượng -->
                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input id="quantity" class="form-control" type="number" name="quantity" value="<?= $Product['quantity'] ?>" required>
                </div><br>

                <!-- Nút cập nhật -->
                <input type="submit" name="btn_update" value="Cập nhật sản phẩm" style="width: 200px;" class="btn btn-primary">
            </form>
        </div>
    </div>

    <?php if (isset($_POST['btn_update'])): ?>
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Sản phẩm đã được cập nhật thành công.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '?act=listproduct';
            });
        </script>
    <?php endif; ?>
</body>

</html>
