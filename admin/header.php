<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Panel</title>
</head>

<body class="text-dark bg-light">

    <!-- Sidebar -->
    <div class="d-flex flex-column bg-dark text-light vh-100 position-fixed" style="width: 250px;">
        <div class="p-3 border-bottom border-secondary">
            <a href="index.php" class="d-flex align-items-center text-light text-decoration-none">
                <img src="<?php echo isset($_SESSION['user'])
                    ? 'https://tse4.mm.bing.net/th?id=OIP.yZVwgbmWs-5ZtRGQgiryyAHaHa&pid=Api&P=0&h=180' . $_SESSION['user']['avatar']
                    : 'https://cdn.sforum.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg'; ?>" alt="Avatar"
                    class="rounded-circle me-2" style="width: 40px; height: 40px;">
                <span class="fw-bold">
                    <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Admin'; ?>
                </span>
            </a>
        </div>
        <nav class="nav flex-column mt-3">
            <a href="index.php" class="nav-link text-light px-3"><i class="fa-solid fa-house me-2"></i>Trang chủ</a>
            <a href="index.php?act=listproduct" class="nav-link text-light px-3"><i
                    class="fa-solid fa-book me-2"></i>Sách</a>
            <a href="index.php?act=listDmuc" class="nav-link text-light px-3"><i class="fa-solid fa-list me-2"></i>Danh
                mục</a>
            <a href="index.php?act=listTacGia" class="nav-link text-light px-3"><i class="fa-solid fa-at me-2"></i>Tác
                giả</a>
            <a href="index.php?act=nhaXuatBan" class="nav-link text-light px-3"><i
                    class="fa-solid fa-bookmark me-2"></i>Nhà xuất bản</a>
            <a href="index.php?act=order" class="nav-link text-light px-3"><i
                    class="fa-solid fa-cart-shopping me-2"></i>Đơn hàng</a>
            <a href="index.php?act=account" class="nav-link text-light px-3"><i class="fa-regular fa-user me-2"></i>Tài
                khoản</a>
            <a href="index.php?act=comment" class="nav-link text-light px-3"><i
                    class="fa-regular fa-comment me-2"></i>Bình luận</a>
            <a href="index.php?act=logout" class="nav-link text-light px-3"><i class="fa-solid fa-gear me-2"></i>Đăng
                xuất</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ms-auto" style="margin-left: 250px;">
        <header class="bg-white shadow-sm py-2 px-4 d-flex align-items-center sticky-top">
            <button class="btn btn-outline-secondary d-md-none me-3">
                <i class="ri-menu-line"></i>
            </button>
            <nav class="breadcrumb mb-0">
                <a href="#" class="breadcrumb-item">Dashboard</a>
                <span class="breadcrumb-item active">Analytics</span>
            </nav>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3">Xin chào,
                    <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Admin'; ?></span>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <img src="<?php echo isset($_SESSION['user'])
                            ? 'https://tse4.mm.bing.net/th?id=OIP.yZVwgbmWs-5ZtRGQgiryyAHaHa&pid=Api&P=0&h=180' . $_SESSION['user']['avatar']
                            : 'https://cdn.sforum.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg'; ?>"
                            alt="Avatar" class="rounded-circle" style="width: 35px; height: 35px;">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="../">Vào Website</a></li>
                        <li><a class="dropdown-item" href="index.php?act=logout">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4">
            <!-- Content Goes Here -->
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>