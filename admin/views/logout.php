<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy tất cả các session
session_unset();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng về trang đăng nhập (login.php)
header('Location: login.php');
exit();
?>
