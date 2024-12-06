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
            // Lấy tất cả các sản phẩm trong giỏ hàng (không cần productId và variantId)
            $cartItems = $this->cartModel->getCartItems($cart_id);
        } else {
            $cartItems = [];
        }
    
        require_once 'views/cart.php';
    }
    

    // Thêm sản phẩm vào giỏ hàng
    // Giả sử bạn đang thêm vào giỏ hàng
    public function addToCart() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id);
    
        if (!$cart_id) {
            // Tạo mới giỏ hàng nếu chưa có
            $cart_id = $this->cartModel->createCart($user_id);
        }
    
        // Lấy thông tin sản phẩm và biến thể từ POST
        $productId = $_POST['id'];
        $variantId = $_POST['variant_id'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1; // Default quantity is 1
    
        // Lấy thông tin sản phẩm và biến thể
        $product = $this->cartModel->getProductById($productId);
        $variant = $this->cartModel->getVariantById($variantId);
    
        if ($product && $variant) {
            // Kiểm tra xem sản phẩm với biến thể đã có trong giỏ hàng chưa
            $cartItem = $this->cartModel->getCartItem($cart_id, $productId, $variantId);
            
            if ($cartItem) {
                // Cập nhật số lượng nếu đã có sản phẩm với biến thể trong giỏ
                $newQuantity = $cartItem['quantity'] + $quantity;
                $this->cartModel->updateCartItemQuantity($cart_id, $productId, $variantId, $newQuantity);
            } else {
                // Tính giá sau giảm giá
                $sale = $product['price'] - ($product['price'] / 100) * $product['sale']+$variant['price'];
                // Thêm sản phẩm vào giỏ hàng nếu chưa có
                $this->cartModel->addToCartItems($cart_id, $productId, $variantId, $quantity, $sale);
            }
    
            // Thông báo và điều hướng lại giỏ hàng
            echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng.');</script>";
            header("Location: index.php?act=cart");
            exit;
        } else {
            echo "<script>alert('Không tìm thấy sản phẩm hoặc biến thể.');</script>";
            header("Location: index.php");
            exit;
        }
    }
    
    
    
    


    // Cập nhật số lượng sản phẩm trong giỏ hàng
    // Cập nhật số lượng sản phẩm trong giỏ hàng
public function updateQuantity() {
    if (!isset($_SESSION['id'])) {
        header("Location: index.php?act=login");
        exit;
    }

    $user_id = $_SESSION['id'];
    $cart_id = $this->cartModel->getCartIdByUserId($user_id);

    if (isset($_POST['quantities']) && $cart_id) {
        foreach ($_POST['quantities'] as $cartItemId => $quantity) {
            // Kiểm tra và đảm bảo số lượng không dưới 1
            $quantity = max(1, (int)$quantity);
            $this->cartModel->updateCartItemQuantityById($cart_id, $cartItemId, $quantity);
        }
        
        // Trả về kết quả cập nhật dạng JSON
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['error' => 'Giỏ hàng không tìm thấy.']);
        exit;
    }
}

    public function getCartItemCount() {
        if (isset($_SESSION['id'])) {
            $userId = $_SESSION['id'];
            $cartId = $this->cartModel->getCartIdByUserId($userId); // Lấy cart_id từ user_id

            if ($cartId) {
                $itemCount = $this->cartModel->countCartItems($cartId); // Lấy tổng số lượng từ CartModel
                echo $itemCount; // Trả về số lượng
            } else {
                echo 0; // Trả về 0 nếu không có giỏ hàng
            }
        } else {
            echo 0; // Trả về 0 nếu người dùng chưa đăng nhập
        }
    }


    

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id'];
        $cart_id = $this->cartModel->getCartIdByUserId($user_id);
    
        if (isset($_GET['product_id']) && isset($_GET['variant_id']) && $cart_id) {
            $product_id = $_GET['product_id'];
            $variant_id = $_GET['variant_id'];
            
            // Xóa sản phẩm khỏi giỏ hàng dựa vào product_id và variant_id
            $this->cartModel->removeFromCart($cart_id, $product_id, $variant_id);
            echo "<script>alert('Đã xóa sản phẩm khỏi giỏ hàng');</script>";
            header("location: ?act=cart");
        } else {
            // Trường hợp không hợp lệ
            echo json_encode(['error' => 'Không thể xóa sản phẩm.']);
            exit;
        }
    }
    
    
}
?>
