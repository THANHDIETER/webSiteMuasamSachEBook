<?php
    class cartModel {
        public $conn;
        function __construct() {
            $this->conn = connectDB();
        }
        
            public function getProductById($id) {
                $sql = "SELECT * FROM products WHERE id = $id";
                $stmt = $this->conn->prepare($sql);      
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function getCartItem($cart_id, $product_id) {
                $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function updateCartItemQuantity($cart_id, $product_id, $quantity) {
                $sql = "UPDATE cart_items SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
            }
            public function addToCartItems($cart_id, $product_id, $quantity, $price) {
                $sql = "INSERT INTO cart_items (cart_id, product_id, quantity, price) 
                        VALUES (:cart_id, :product_id, :quantity, :price)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':price', $price, PDO::PARAM_STR);
                $stmt->execute();
            }
            public function createCart($user_id) {
                $sql = "INSERT INTO carts (user_id) VALUES ($user_id)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                return $this->conn->lastInsertId(); // Trả về `cart_id` vừa tạo
            }
            public function getCartIdByUserId($user_id) {
                $sql = "SELECT id FROM carts WHERE user_id = $user_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $cart = $stmt->fetch(PDO::FETCH_ASSOC);
                return $cart['id'] ?? null;
            }
            public function getCartItems($cart_id) {
                $sql = "SELECT c.id, c.product_id, c.quantity, c.price, p.name, p.img
                        FROM cart_items c
                        JOIN products p ON c.product_id = p.id
                        WHERE c.cart_id = $cart_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả sản phẩm trong giỏ hàng
            }
        }
        
        ?>
        