<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tài Khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Danh sách Tài Khoản</h1>

        <!-- Nút Thêm Tài Khoản -->
        <div class="mb-3">
            <a href="add.php" class="btn btn-success">Thêm Tài Khoản</a>
        </div>

        <!-- Bảng Danh Sách Tài Khoản -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Người Dùng</th>
                    <th>Email</th>
                    <th>Quyền Admin</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data) && is_array($data)): ?>
                <?php foreach ($data as $account): ?>
                    <tr>
                        <td><?= $account['id'] ?></td>
                        <td><?= htmlspecialchars($account['name']) ?></td>
                        <td><?= htmlspecialchars($account['email']) ?></td>
                        <td><?= $account['is_admin'] == 1 ? 'Admin' : 'User' ?></td>
                        <td>
                            <a href="delete.php?id=<?= $account['id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Không có tài khoản nào.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
