<?php
session_start();
require_once 'connect/function.php';
require_once 'controllers/homeController.php';
require_once 'controllers/cartController.php';
require_once 'controllers/addressController.php';
require_once 'models/homeModel.php';
require_once 'models/addressModel.php';
require_once 'models/cartModel.php';

// Lấy giá trị act từ URL, nếu không có sẽ mặc định là '/'
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null; // Xử lý id khi cần thiết

try {
    match ($act) {
        // Các hành động của homeController
        '/'         => (new homeController())->home(),
        'detail'    => (new homeController())->detail($id),
        'home'      => (new homeController())->home(),
        'login'     => (new homeController())->login(),
        'logout'    => (new homeController())->logout(),
        'product'   => (new homeController())->product(),
        'register'  => (new homeController())->register(),

        // Các hành động của cartController
        'addToCart'         => (new CartController())->addToCart($id),
        'updateQuantity'    => (new CartController())->updateQuantity(),
        'cart'              => (new CartController())->viewCart(),

        // Các hành động của addressController
        'checkout'      => (new addressController())->checkout(),
        'processCheckout' => (new addressController())->processCheckout(),
        'address' => (new addressController())->updateAddress(),  // Đảm bảo có action này

        default => throw new Exception("Hành động không hợp lệ hoặc không tồn tại"),
    };
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
