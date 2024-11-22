<?php
    session_start();
    require_once 'connect/function.php';
    require_once 'controllers/homeController.php';
    require_once 'controllers/cartController.php';
    require_once 'controllers/addressController.php';
    require_once 'models/homeModel.php';
    require_once 'models/addressModel.php';
    require_once 'models/cartModel.php';

    $act = $_GET['act'] ?? '/';
    match ($act) {
        '/' => (new homeController())->home(),
        'detail' => (new homeController())->detail($_GET['id']),
        'home' => (new homeController())->home(),
        'addToCart' => (new CartController())->addToCart($_GET['id']),
        'updateQuantity' => (new CartController())->updateQuantity(),
        'cart' => (new CartController())->viewCart(),
        'removeFromCart' => (new CartController())->removeFromCart($_GET['id']),
        'login' => (new homeController())->login(),
        'logout' => (new homeController())->logout(),
        'product' => (new homeController())->product(),
        'register' => (new homeController())->register(),
        'dmid' => (new homeController())->dmshow($_GET['id']),
        'address' => (new addressController())->address(),
        'saveAddress' => (new addressController())->saveAddress(),
        'checkout' => (new addressController())->checkout(),
    }
?>
