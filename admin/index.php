<?php
session_start();

// Require toàn bộ file Commons
require_once '../connect/function.php';
// Require toàn bộ file Controllers
require_once "./views/user/checkUser.php";

require_once 'controllers/controller.php';
require_once 'controllers/controllerDanhMuc.php';
require_once 'controllers/controllerTacGia.php';
require_once 'controllers/controllerNhaXuatBan.php';
require_once 'controllers/orderController.php';
// Require toàn bộ file Models
require_once 'models/model.php';
require_once 'models/modelDmuc.php';
require_once 'models/modelTacGia.php';
require_once 'models/modelNhaXuatBan.php';
require_once 'models/orderModel.php';
// Route
$act = $_GET['act'] ?? '/';
match ($act) {
    // Trang chủ quản trị
    '/' => (new productController)->login(),
    'dashboard' => (new productController())->dashboard(),
    'insert' => (new productController())->insert(),
    'listproduct' => (new productController())->listProduct(),
    'delete' => (new productController())->delete($_GET['id']),
    'update' => (new productController())->update($_GET['id']),
    

    // Danhmuc
    'listdanhmuc' => (new danhmucController())->listDanhMuc(),
    'addDanhMuc' => (new danhmucController())->addDanhMuc(),
    'deleteDmuc' => (new danhmucController())->delete($_GET['id']),
    'updateDmuc' => (new danhmucController())->update($_GET['id']),

    // Tacgia
    'listtacgia' => (new tacgiaController())->listTacGia(),
    'addTacGia' => (new tacgiaController())->addTacGia(),
    'deleteTacGia' => (new tacgiaController())->deleteTacGia($_GET['id']),
    'updateTacGia' => (new tacgiaController())->updateTacGia($_GET['id']),

    //NXB
    'listNhaXuatBan' => (new nhaXuatBanController())->listNhaXuatBan(),
    'addNhaXuatBan' => (new nhaXuatBanController())->addNhaXuatBan(),
    'deleteNhaXuatBan' => (new nhaXuatBanController())->deleteNhaXuatBan($_GET['id']),
    'updateNhaXuatBan' => (new nhaXuatBanController())->updateNhaXuatBan($_GET['id']),

    //order
    'order' => (new orderController())->adminOrders(),
    'confirmOrder' => (new orderController())->confirmOrder(),
    'orderDetail' => (new orderController())->viewOrderDetail(),
    'shipOrder' => (new orderController())->shipOrder(),  // Giao hàng
    'cancelOrder' => (new orderController())->cancelOrder(),
    // quản lỳ bình luận
    
    'comment' => (new productController())->comment(),
    'logout' => (new productController())->logout(),

};
    ?>