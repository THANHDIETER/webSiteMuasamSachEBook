<?php
require_once 'models/cartModel.php';

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    public function addToCart($productId) {
        session_start();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $product = $this->cartModel->getProductById($productId);

        if ($product) {
            $exists = false;

            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $productId) {
                    $item['quantity']++;
                    $exists = true;
                    break;
                }
            }
            
            if (!$exists) {
                $_SESSION['cart'][] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'img' => $product['img'],
                    'price' => $product['price'],
                    'sale' => $product['sale'],
                    'quantity' => 1
                ];
            }  
        }
        

        header("Location: index.php?act=cart");
        exit;
    }
    
 
    public function updateQuantity() {
     session_start();

     if (isset($_SESSION['cart'], $_POST['quantities'])) {
         foreach ($_POST['quantities'] as $productId => $quantity) {
             foreach ($_SESSION['cart'] as &$item) {
                 if ($item['id'] == $productId) {
                     $item['quantity'] = max(1, (int)$quantity); // Minimum quantity is 1
                     break;
                 }
             }
         }
     }

     header("Location: index.php?act=cart");
     exit;
 }
 

 

    public function viewCart() {
        $cartItems = $_SESSION['cart'] ?? [];
        require_once 'views/cart.php';
    }

    public function removeFromCart($productId) {
        session_start();

        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
                return $item['id'] != $productId;
            });
        }

        header("Location: index.php?act=cart");
        exit;
    }
}
?>
