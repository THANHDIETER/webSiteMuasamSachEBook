<?php
class CartModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin sản phẩm trong giỏ hàng
    public function getCartItem($cart_id, $product_id) {
        $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartItemQuantity($cart_id, $product_id, $newQuantity) {
        // Lấy thông tin sản phẩm từ bảng products để lấy giá
        $product = $this->getProductById($product_id); 
        if ($product) {
            // Cập nhật số lượng và giá của sản phẩm trong giỏ hàng
            $sql = "UPDATE cart_items 
                    SET quantity = :newQuantity, price = :price
                    WHERE cart_id = :cart_id AND product_id = :product_id";
            
            $stmt = $this->conn->prepare($sql);
            
            // Gán giá trị vào các tham số
            $stmt->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $product['price'], PDO::PARAM_INT); // Giá sản phẩm
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            
            // Thực thi câu lệnh
            $stmt->execute();
        }
    }
    

    // Thêm sản phẩm vào giỏ hàng
    public function addToCartItems($cart_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO cart_items (cart_id, product_id, quantity, price) 
                VALUES (:cart_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Tạo giỏ hàng mới
    public function createCart($user_id) {
        $sql = "INSERT INTO carts (user_id) VALUES (:user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $this->conn->lastInsertId(); // Trả về `cart_id` vừa tạo
    }

    // Lấy cart_id theo user_id
    public function getCartIdByUserId($user_id) {
        $sql = "SELECT id FROM carts WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);
        return $cart['id'] ?? null;
    }

    // Lấy danh sách sản phẩm trong giỏ hàng
    public function getCartItems($cart_id) {
        $sql = "SELECT c.id, c.product_id, c.quantity, c.price, p.name, p.img
                FROM cart_items c
                JOIN products p ON c.product_id = p.id
                WHERE c.cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($cart_id, $product_id) {
        $sql = "DELETE FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
