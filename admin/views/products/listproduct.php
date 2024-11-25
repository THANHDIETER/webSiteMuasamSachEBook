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
        <h1 class="fw-bold text-center mb-4">Danh sách sản phẩm</h1>
        <!-- Product List Table -->
        <div class="table-responsive">
            <section>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sách</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Tên tác giả</th>
                            <th>Tên danh mục</th>
                            <th>Tên nhà xuất bản</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allProduct as $key): ?>
                            <tr>
                                <td><?php echo $key['id'] ?></td>
                                <td><?php echo $key['ten'] ?></td>
                                <td><img src="./assets/images/prod/books/<?php echo $Product['img']; ?>" class="ms-3 mb-4"
                                        style="width:200px; height:auto"></td>
                                <td><?php echo number_format($key['gia'], 0, ',', '.'); ?> ₫</td>
                                <td><?php echo $key['tac_gia']; ?></td>
                                <td><?php echo $key['danh_muc_name']; ?></td>
                                <td><?php echo $key['nha_san_xua_name']; ?></td>
                                <td>
                                    <a href="?act=update&id=<?php echo $key['id']; ?>"
                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="?act=delete&id=<?php echo urlencode($key['id']); ?>"
                                        class="btn btn-sm btn-outline-danger" onclick="return confirmDelete()">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    <script