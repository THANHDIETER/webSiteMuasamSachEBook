<?php require_once "user/checkUser.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Tài Khoản</title>
    <link rel="stylesheet" href="../assets/stytes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- link font roboto -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <?php require_once "components/header.php"; ?>
    <div class="main-content">
        
        <h1 class="bg-primary text-white py-2 rounded-top mb-3 mt-4 text-center">Quản Lý Tài Khoản</h1>
        <!-- Danh muc Table -->
        <div class="table-responsive">
            <section>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr class="table-info text-white">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Avatar</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Địa chỉ</th>
                            <th>Is admin</th>
                    </thead>

                    <?php foreach ($allAccount as $key): ?>
                        <tr>
                            <td><?php echo $key['id'] ?></td>
                            <td><?php echo $key['name'] ?></td>
                            <td><?php echo $key['avatar'] ?></td>
                            <td><?php echo $key['phone'] ?></td>
                            <td><?php echo $key['email'] ?></td>
                            <td><?php echo $key['password'] ?></td>
                            <td><?php echo $key['address'] ?></td>
                            <td><?php echo $key['is_admin'] == 1 ? 'Admin' : 'User' ?></td>
                            <td>
                                <a href="?act=account&id=<?php echo urlencode($key['id']); ?>"
                                    class="btn btn-sm btn-outline-danger" onclick="return confirmDelete()">Remove
                                </a>
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