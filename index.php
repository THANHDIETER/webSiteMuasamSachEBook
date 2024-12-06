<?php
session_start();
require_once 'connect/function.php';  // Kết nối cơ sở dữ liệu và các hàm tiện ích
require_once 'controllers/homeController.php';   // Controller quản lý trang chính và các sản phẩm
require_once 'controllers/cartController.php';   // Controller quản lý giỏ hàng
require_once 'controllers/addressController.php'; // Controller quản lý địa chỉ và đặt hàng
require_once 'models/homeModel.php';  // Model liên quan đến dữ liệu sản phẩm, người dùng
require_once 'models/addressModel.php'; // Model quản lý địa chỉ và đơn hàng
require_once 'models/cartModel.php';   // Model xử lý giỏ hàng

// Lấy hành động và ID từ URL
$act = $_GET['act'] ?? '/'; // Nếu không có hành động, mặc định là '/'
$id = $_GET['id'] ?? null;  // Lấy ID từ URL nếu có

try {
    match ($act) {
        // Các hành động của homeController
        '/'           => (new homeController())->home(),
        'detail'      => (new homeController())->detail($id),
        'home'        => (new homeController())->home(),
        'login'       => (new homeController())->login(),
        'logout'      => (new homeController())->logout(),
        'product'     => (new homeController())->product(),
        'register'    => (new homeController())->register(),
        'dmid'        => (new homeController())->dmshow($_GET['id']), // Xử lý danh mục theo ID
        'profile' => (new homeController())->profile(),

        // Các hành động của cartController
        'addToCart'   => (new CartController())->addToCart($id),
        'updateQuantity' => (new CartController())->updateQuantity(),
        'cart'        => (new CartController())->viewCart(),
        'remove_from_cart' => (new CartController())->removeFromCart($id),
        'cartItemCount'   => (new CartController())->getCartItemCount(),

        // Các hành động của addressController
        'checkout'    => (new addressController())->checkout(),
        'processCheckout' => (new addressController())->processCheckout(),
        'address'     => (new addressController())->updateAddress(),
        'order'       => (new addressController())->showOrder(),
        'orderDetail' => (new addressController())->viewOrderDetail($id),
        'cancelOrder' => (new addressController())->cancelOrder($id),

        // Hành động tìm kiếm sản phẩm
        'search'      => (new homeController())->search($_GET['keySearch'] ?? ''),  // Thêm kiểm tra keySearch

        // Thêm các hành động liên quan đến reset mật khẩu
        'forgotPassword' => (new homeController())->forgotPassword(), // Mở rộng với chức năng quên mật khẩu
        'resetPassword'  => (new homeController())->resetPassword(), // Xử lý reset mật khẩu với token
        
        default => throw new Exception("Hành động không hợp lệ hoặc không tồn tại"),
    };
} catch (Exception $e) {
    // Xử lý lỗi và thông báo
    echo "Lỗi: " . $e->getMessage();
}
?>
