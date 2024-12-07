<!-- views/profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once './components/header.php' ?>
    <div class="main-content container mt-5 px-5">
        <h1 class="mb-4">Hồ Sơ Cá Nhân</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= $user['avatar'] ? htmlspecialchars($user['avatar']) : 'default-avatar.png' ?>" 
                             alt="Avatar" class="img-thumbnail" width="200">
                    </div>
                    <div class="col-md-8">
                        <h3><?= htmlspecialchars($user['name']) ?></h3>
                        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?></p>
                        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($user['address'] ?? 'Chưa cập nhật') ?></p>
                        <a href="?act=editProfile" class="btn btn-primary">Chỉnh sửa thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
