<?php
require_once 'models/cartModel.php';
class CartController {
    private $cartModel;
    public function __construct() {
        $this->cartModel = new CartModel();
    }
    public function viewCart() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id);
        if ($cart_id) {
            $cartItems = $this->cartModel->getCartItems($cart_id);
        } else {
            $cartItems = [];
        }
        require_once 'views/cart.php';
    }
    
    public function addToCart($productId) {
       
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id); 
        if (!$cart_id) {
            $cart_id = $this->cartModel->createCart($user_id);
        }
        $product = $this->cartModel->getProductById($productId);
        if ($product) {
            $cartItem = $this->cartModel->getCartItem($cart_id, $productId);
            if ($cartItem) {
                $newQuantity = $cartItem['quantity'] + 1;
                $this->cartModel->updateCartItemQuantity($cart_id, $productId, $newQuantity);
            } else {
                $this->cartModel->addToCartItems($cart_id, $productId, 1, $product['price']);
            }
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
            header("Location: index.php?act=cart");
            exit;
        } else {
            echo "<script>alert('Không tìm thấy sản phẩm.');</script>";
            header("Location: index.php");
            exit;
        }
    }
    public function updateQuantity() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id); 
        if (isset($_POST['quantities']) && $cart_id) {
            foreach ($_POST['quantities'] as $productId => $quantity) {
                $this->cartModel->updateCartItemQuantity($cart_id, $productId, max(1, (int)$quantity));
            }
        }
    
        // Sau khi cập nhật số lượng, điều hướng lại đến giỏ hàng
        header("Location: index.php?act=cart");
        exit;
    }
    
}
?>