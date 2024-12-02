<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Biến thể</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }
    .container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 95%; /* Giới hạn chiều rộng container */
        margin: auto;
    }
    table {
        width: 95%;
        max-width: 95%;
        overflow-x: auto;
    }
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        white-space: nowrap; /* Giữ nội dung không bị xuống dòng */
    }
    .btn {
        border-radius: 5px;
    }
    .btn-warning, .btn-danger, .btn-success {
        color: #fff;
    }
    h1 {
        color: #343a40;
        text-align: center;
    }
    .box{
          width: 95%;
    }
</style>

</head>
<body>
<?php require_once 'components/header.php'; ?>

<div class="container main-content mt-5">
    <h1 class="mb-4">Danh sách Biến thể</h1>
    <div  class="box d-flex justify-content-between flex-wrap mb-3">
        <a href="?act=newVariant" class="btn btn-success">Thêm Biến thể mới</a>
        <form class="d-flex " action="" method="GET">
            <input type="hidden" name="act" value="listVariants">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm biến thể..." name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Format</th>
                    <th>Ngôn ngữ</th>
                    <th>Phiên bản</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($variants)): ?>
                    <tr>
                        <td colspan="7" class="text-center">Không tìm thấy biến thể nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($variants as $variant): ?>
                        <tr>
                            <td><?= $variant['id'] ?></td>
                            <td><?= htmlspecialchars($variant['format']) ?></td>
                            <td><?= htmlspecialchars($variant['language']) ?></td>
                            <td><?= htmlspecialchars($variant['edition']) ?></td>
                            <td><?= number_format($variant['price'], 0, ',', '.') ?> VND</td>
                            <td><?= $variant['stock'] ?></td>
                            <td>
                                <a href="?act=editVariant&variant_id=<?= $variant['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="?act=deleteVariant&variant_id=<?= $variant['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa biến thể này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
