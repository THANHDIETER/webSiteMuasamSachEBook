<?php
session_start();

// Require toàn bộ file Commons
require_once '../connect/function.php';
// Require toàn bộ file Controllers


require_once 'controllers/controller.php';
require_once 'controllers/controllerDanhMuc.php';
require_once 'controllers/controllerTacGia.php';
require_once 'controllers/controllerNhaXuatBan.php';
// Require toàn bộ file Models
require_once 'models/model.php';
require_once 'models/modelDmuc.php';
require_once 'models/modelTacGia.php';
require_once 'models/modelNhaXuatBan.php';
// Route
$act = $_GET['act'] ?? '/';
match ($act) {
    // Trang chủ quản trị
    '/' => (new productController)->login(),
    'home' => (new productController)->home(),
    'insert' => (new productController())->insert(),
    'listproduct' => (new productController())->listProduct(),
    'delete' => (new productController())->delete($_GET['id']),
    //'update' => (new productController())->update($_GET['id']),
    // 'cart' => (new productController())->cart(),

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
    // quản lỳ bình luận
    
    'comment' => (new productController())->comment(),
    'logout' => (new productController())->logout(),

}
    ?>