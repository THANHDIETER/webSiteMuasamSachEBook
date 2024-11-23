<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách Ebook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="main-content">
        <div class="container">
            <div>
                <a href="index.php?act=insert" class="btn btn-success">Nhập thêm</a>
            </div>
        </div>
        <h1 class="bg-primary text-white py-2 rounded-top mb-3 mt-4 text-center">Danh sách sản phẩm</h1>
        <!-- Product List Table -->
        <div class="table-responsive">
            <section>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr class="table-info text-white">
                            <th>ID</th>
                            <th>Tên sách</th>
                            <th>Tên danh mục</th>
                            <th>Tên nhà xuất bản</th>
                            <th>Tên tác giả</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allProduct as $key): ?>
                            <tr>
                                <td><?php echo $key['id'] ?></td>
                                <td><?php echo $key['name'] ?></td>
                                <td><?php echo $key['category_name']; ?></td>
                                <td><?php echo $key['publisher_name']; ?></td>
                                <td><?php echo $key['author_name']; ?></td>
                                <td><img src="./assets/images/prod/books/<?php echo $key['img']; ?>" class="ms-3 mb-4"
                                        style="width:100px; height:auto"></td>
                                <td><?php echo number_format($key['price'], 0, ',', '.'); ?> ₫</td>



                                <td>
                                    <a href="?act=update&id=<?php echo $key['id']; ?>"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="?act=delete&id=<?php echo urlencode($key['id']); ?>"
                                        class="btn btn-sm btn-outline-danger" onclick="return confirmDelete()">Remove</a>
                                </td>
                            </tr>
                            <script>
                                function confirmDelete() {
                                    return confirm('Bạn xác nhận xóa sản phẩm này!');
                                }
                            </script>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <script