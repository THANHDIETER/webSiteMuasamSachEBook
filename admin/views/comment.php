<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bình Luận</title>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-content">
        
        <h1 class="bg-primary text-white py-2 rounded-top mb-3 mt-4 text-center">Quản Lý Bình Luận</h1>
        <!-- Danh muc Table -->
        <div class="table-responsive">
            <section>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr class="table-info text-white">
                            <th>ID</th>
                            <th>Bình Luận </th>
                            <th>Thời gian</th>
                            <th>Thao Tác</th>
                    </thead>

                    <?php foreach ($allCmt as $key): ?>
                        <tr>
                            <td><?php echo $key['id'] ?></td>
                            <td><?php echo $key['content'] ?></td>
                            <td><?php echo $key['created_at'] ?></td>
                            <td>
                                <a href="?act=comment&id=<?php echo urlencode($key['id']); ?>"
                                    class="btn btn-sm btn-outline-danger" onclick="return confirmDelete()">Remove
                                </a>
                                <!-- <a href="#" class="btn btn-sm btn-outline-secondary">Thêm bìa</a> -->
                            </td>
                        </tr>





                        <script>
                            function confirmDelete() {
                                return confirm('Bạn xác nhận xóa danh mục này!');
                            }
                        </script>
                    <?php endforeach; ?>
                    </tbody>

                </table>



            </section>



        </div>


    </div>
    </div>

</body>



</html>