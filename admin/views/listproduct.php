<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách Ebook</title>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>


    <div class="container my-4 ms-auto " style="margin-left: 250px;">
        <div class=""><a href="index.php?act=insert" class="btn btn-success">Nhập
                thêm</a></div>
    </div>
    <h1 class="fw-bold text-center">Danh sách sản phẩm</h1>

    <!-- ProductList Table -->
    <div class="table-responsive">
        <section>
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sách</th>
                        <!-- <th>Hình ảnh</th> -->
                        <th>Giá </th>
                        <!-- <th>Mô tả</th> -->
                        <th>Tên tác giả</th>
                        <th>Tên danh mục</th>
                        <th>Tên nhà xuất bản</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php foreach ($allProduct as $key): ?>
                    <tr>
                        <td><?php echo $key['id'] ?></td>
                        <td><?php echo $key['ten'] ?></td>

                        <!-- <img src="../assets/images/prod/books/<?php echo $key['img']; ?>" alt="Book Image"
                                class="img-fluid" style="width: 80px; height: auto;"> -->

                        <td><?php echo number_format($key['gia'], 0, ',', '.'); ?> ₫</td>


                        <td><?php echo $key['tac_gia']; ?></td>
                        <td><?php echo $key['danh_muc_name']; ?></td>
                        <td><?php echo $key['nha_san_xua_name']; ?></td>
                        <td>
                            <a href="?act=update&id=<?php echo $key['id']; ?>" class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>
                            <a href="?act=delete&id=<?php echo urlencode($key['id']); ?>"
                                class="btn btn-sm btn-outline-danger" onclick="return confirmDelete()">Remove
                            </a>
                            <!-- <a href="#" class="btn btn-sm btn-outline-secondary">Thêm bìa</a> -->
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

</body>



</html>