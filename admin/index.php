<?php
session_start();
// Require toàn bộ file Commons
 require_once '../connect/function.php';

//  require_once 'views/header.php';
 // Require toàn bộ file Controllers

 require_once 'controllers/controller.php';
 require_once 'controllers/QuanLyController.php';

 // Require toàn bộ file Models
 require_once 'models/model.php';
 require_once 'models/QuanLyModel.php';

 

 // Route
$act = $_GET['act'] ?? '/';
match ($act) {
    // Trang chủ quản trị
    '/' => (new productController)->login(),
    'insert' => (new productController())->insert(),
    'listproduct' => (new productController())->listProduct(),
    'delete' => (new productController())->delete($_GET['id']),
    'update' => (new productController())->update($_GET['id']),
    'cart' => (new productController())->cart(),

    // quản lý tài khoản


    // Quản lý tài khoản
 'account' => (new productController())->account(),
  
}
?>