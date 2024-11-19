<?php
session_start();
// Require toàn bộ file Commons
require_once '../connect/function.php';
// Require toàn bộ file Controllers

require_once "header.php";

require_once 'controllers/controller.php';
require_once 'controllers/controllerDanhMuc.php';
require_once 'controllers/controllerTacGia.php';
// Require toàn bộ file Models
require_once 'models/model.php';
require_once 'models/modelDmuc.php';
require_once 'models/modelTacGia.php';
// Route
$act = $_GET['act'] ?? '/';
match ($act) {
    // Trang chủ quản trị
    // '/' => (new productController)->login(),
    'insert' => (new productController())->insert(),
    'listproduct' => (new productController())->listProduct(),
    'delete' => (new productController())->delete($_GET['id']),
    'update' => (new productController())->update($_GET['id']),
    // 'cart' => (new productController())->cart(),

    // Danhmuc
    'listdanhmuc' => (new danhmucController())->listDanhMuc(),
    'addDanhMuc' => (new danhmucController())->addDanhMuc(),
    'deleteDmuc' => (new danhmucController())->delete($_GET['id']),
    'updateDmuc' => (new danhmucController())->update($_GET['id']),

    // Tacgia
    'listtacgia' => (new tacgiaController())->listTacGia(),

}
    ?>