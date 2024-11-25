<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cap nhat san pham</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-content">
        <div class="container">
            <h1 class="fw-bold text-center">Cập nhật sản phẩm</h1>
            <form action="" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="<?= $Product['id'] ?>" id="">
                <div class="form-group">
                    <label>Tên sách</label>
                    <input class="form-control" value="<?= $Product['name'] ?>" type="text" name="name" ?>
                </div><br>
                <div class="form-group">
                    <label>Danh mục</label>
                    <select multiple class="form-control" type="text" id="category_id" name="category_id">
                        <option value="0" selected>Chọn Danh mục</option>
                        <?php foreach ($listDanhMuc as $key): ?>
                            <option value="<?= $key['id'] ?>">
                                <?= $key['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div><br>

                <div class="form-group">
                    <label>Nhà xuất bản</label>
                    <select multiple class="form-control" type="text" id="category_id" name="category_id">
                        <option value="0" selected>Chọn nhà xuất bản</option>
                        <?php foreach ($listNhaXuatBan as $key): ?>
                            <option value="<?= $key['id'] ?>">
                                <?= $key['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div><br>
                <div class="form-group">
                    <label>Tác giả</label>
                    <select multiple class="form-control" type="text" id="author_id" name="author_id">
                        <option value="0" selected>Chọn tác giả</option>
                        <?php foreach ($listTacGia as $key) {
                            if ($Product["author_id"] == $value["id"]) {
                                echo '<option value="' . $value["id"] . '" selected>' . $value["name"] . '</option>';
                            } else {
                                echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                            }
                        } ?>


                    </select>

                </div><br>
                <div class="form-group">
                    <label for=>Hình ảnh</label>
                    <input class="form-control" type="file" name="img" value="<?= $Product['img'] ?>" ?>
                </div><br>
                <div class="form-group">
                    <label>Giá</label>
                    <input class="form-control" type="number" name="price" value="<?= $Product['price'] ?>" ?>
                </div><br>

                <input type="submit" name="btn_update" id="" value="UPDATE PRODUCT" style="width: 200px; "
                    class="btn btn-primary">
            </form>

        </div>
    </div>
</body>

</html>