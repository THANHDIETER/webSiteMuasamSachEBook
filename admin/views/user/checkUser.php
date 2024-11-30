
<?php 
if (!isset($_SESSION['name']) || (int)$_SESSION['is_admin'] !== 1) {
    echo "<script>alert('Bạn không có quyền truy cập trang này.');</script>";
    header('Location: ' . BASE_URL . '?act=login');
    exit();
}
