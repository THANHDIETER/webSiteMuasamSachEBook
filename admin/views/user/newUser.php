<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Người dùng</title>
    <!-- Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tùy chỉnh thêm cho giao diện */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .main-content {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .btn-sm {
            padding: 6px 12px;
        }

        /* Hiệu ứng khi di chuột qua dòng bảng */
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Tùy chỉnh nút "Xóa" */
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Thêm border cho bảng */
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Tùy chỉnh một chút cho phần đầu bảng */
        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php require_once 'components/header.php'; ?>

    <div class="main-content container mt-5 px-5">
        <h1>Danh sách Người dùng</h1>

        <!-- Nút Thêm Người dùng -->
        <div class="mb-3 text-end">
            <a href="?act=addUser" class="btn btn-success btn-sm">Thêm Người dùng</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>Quyền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name'] ?? '') ?></td>
                         <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                         <td><?= htmlspecialchars($user['phone'] ?? '') ?></td>
                         <td><?= htmlspecialchars($user['address'] ?? '') ?></td>

                        <td><?= $user['is_admin'] == 1 ? 'Admin' : 'User' ?></td>
                        <td>
                            <!-- Chỉnh sửa -->
                            <a href="?act=editUser&user_id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    
                            <!-- Xóa -->
                            <a href="?act=deleteUser&user_id=<?= $user['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                               Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS và Popper.js từ CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
