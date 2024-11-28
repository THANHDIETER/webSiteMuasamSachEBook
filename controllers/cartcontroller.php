<?php
require_once 'models/cartModel.php';

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    // Xem giỏ hàng
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

    // Thêm sản phẩm vào giỏ hàng
    // Giả sử bạn đang thêm vào giỏ hàng
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
        // Debug: kiểm tra giá trị trước khi thêm vào giỏ hàng
        error_log("Product ID: " . $productId);
        error_log("Cart ID: " . $cart_id);

        $cartItem = $this->cartModel->getCartItem($cart_id, $productId);
        if ($cartItem) {
            $newQuantity = $cartItem['quantity'] + 1;
            $this->cartModel->updateCartItemQuantity($cart_id, $productId, $newQuantity);
        } else {
            $sale = $product['price'] - ($product['price']/100)*$product['sale'];
            $this->cartModel->addToCartItems($cart_id, $productId, 1, $sale);
        }
        
        // Debug: Xem lại giỏ hàng sau khi cập nhật
        error_log("Cart Updated: " . print_r($this->cartModel->getCartItems($cart_id), true));

        echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
        header("Location: index.php?act=cart");
        exit;
    } else {
        echo "<script>alert('Không tìm thấy sản phẩm.');</script>";
        header("Location: index.php");
        exit;
    }
}


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantity() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
        
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id);
    
        if (isset($_POST['quantities']) && $cart_id) {
            foreach ($_POST['quantities'] as $productId => $quantity) {
                // Cập nhật số lượng trong giỏ hàng
                $this->cartModel->updateCartItemQuantity($cart_id, $productId, max(1, (int)$quantity));  
            }
        }
    
        header("Location: index.php?act=cart");
        exit;
    }
    

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($productId) {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id);
        if ($cart_id) {
            // Gọi phương thức removeFromCart để xóa sản phẩm
            $this->cartModel->removeFromCart($cart_id, $productId);
        }
        // Điều hướng lại giỏ hàng sau khi xóa sản phẩm
        header("Location: index.php?act=cart");
        exit;
    }
}
?>
