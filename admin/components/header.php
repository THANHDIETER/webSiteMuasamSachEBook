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
    <style>
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: #343a40;
            color: #ffffff;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .main-content {
            margin-left: 250px;
            /* Sidebar width */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>

<body class="text-dark bg-light">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-3 border-bottom border-secondary">
            <a href="index.php" class="d-flex align-items-center text-light text-decoration-none">
                <img class="rounded-circle shadow-1-strong me-3"
                    src="https://lms.languagehub.vn/store/1/default_images/default_profile.jpg" alt="avatar" width="40"
                    height="40" />
                <span class="fw-bold">
                    <?php echo isset($_SESSION['user']) ? $_SESSION['user']['name'] : 'Admin'; ?>
                </span>
            </a>
        </div>
        <nav class="nav flex-column mt-3">
            <a href="index.php?act=dashboard" class="nav-link text-light px-3"><i
                    class="fa-solid fa-house me-2"></i>Trang chủ</a>
            <a href="index.php?act=listproduct" class="nav-link text-light px-3"><i
                    class="fa-solid fa-book me-2"></i>Sách</a>
            <a href="index.php?act=listdanhmuc" class="nav-link text-light px-3"><i
                    class="fa-solid fa-list me-2"></i>Danh
                mục</a>
            <a href="index.php?act=listtacgia" class="nav-link text-light px-3"><i class="fa-solid fa-at me-2"></i>Tác
                giả</a>
            <a href="index.php?act=listNhaXuatBan" class="nav-link text-light px-3"><i
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
    <header style="margin-left: 250px;" class="bg-white shadow-sm py-2 px-4 d-flex align-items-center sticky-top">
        <nav class="breadcrumb mb-0">
            <a href="#" class="breadcrumb-item">Dashboard</a>
            <span class="breadcrumb-item active">Analytics</span>
        </nav>
        <div class="ms-auto d-flex align-items-center">
            <span class="me-3">Xin chào,
                <?php echo $_SESSION['name'] ?></span>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="https://lms.languagehub.vn/store/1/default_images/default_profile.jpg" alt="avatar"
                        width="40" height="40" />
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php
                    echo '
                            <li><a class="dropdown-item" href="../"><i class="bi bi-file-earmark-person"></i> vào website</a></li>
                            <li><a class="dropdown-item" href="?act=profile"><i class="bi bi-person-circle"></i> Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="?act=logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a></li>';
                    ?>
                </ul>
            </div>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>