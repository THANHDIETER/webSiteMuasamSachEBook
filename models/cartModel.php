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
    public function getCartItem($cart_id, $product_id, $variant_id) {
        $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id AND product_id = :product_id AND variant_id = :variant_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một bản ghi nếu tìm thấy
    }

    // Lấy tất cả các sản phẩm trong giỏ hàng
    public function getCartItems($cart_id) {
        $sql = "SELECT ci.id, ci.cart_id, ci.product_id, ci.variant_id, ci.quantity, ci.price, p.name , p.price,p.sale  ,bv.price as variant_price, bv.format, bv.language, bv.edition, p.img
                FROM cart_items ci
                LEFT JOIN products p ON ci.product_id = p.id
                LEFT JOIN book_variants bv ON ci.variant_id = bv.id
                WHERE ci.cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách các sản phẩm trong giỏ
    }

    // Thêm sản phẩm vào giỏ hàng (hoặc cập nhật nếu đã có)
    public function addToCartItems($cart_id, $productId, $variantId, $quantity, $price) {
        // Kiểm tra xem sản phẩm với biến thể đã có trong giỏ chưa
        $cartItem = $this->getCartItem($cart_id, $productId, $variantId);

        // Nếu sản phẩm đã có trong giỏ, cập nhật số lượng
        if ($cartItem) {
            $newQuantity = $cartItem['quantity'] + $quantity;
            // Cập nhật số lượng sản phẩm trong giỏ
            $sql = "UPDATE cart_items SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id AND variant_id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':quantity', $newQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':variant_id', $variantId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Nếu sản phẩm chưa có trong giỏ, thêm mới sản phẩm vào giỏ
            $sql = "INSERT INTO cart_items (cart_id, product_id, variant_id, quantity, price) 
                    VALUES (:cart_id, :product_id, :variant_id, :quantity, :price)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':variant_id', $variantId, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    // Lấy thông tin biến thể theo ID
    public function getVariantById($variant_id) {
        $sql = "SELECT * FROM book_variants WHERE id = :variant_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về một mảng chứa thông tin của biến thể
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCartItemQuantity($cart_id, $product_id, $variant_id, $newQuantity) {
        // Kiểm tra sản phẩm có trong giỏ hay không
        $cartItem = $this->getCartItem($cart_id, $product_id, $variant_id);

        if ($cartItem) {
            // Cập nhật số lượng và giá của sản phẩm trong giỏ hàng
            $sql = "UPDATE cart_items 
                    SET quantity = :newQuantity
                    WHERE cart_id = :cart_id AND product_id = :product_id AND variant_id = :variant_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
            $stmt->execute();
        }
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

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($cart_id, $product_id, $variant_id) {
        $sql = "DELETE FROM cart_items 
                WHERE cart_id = :cart_id AND product_id = :product_id AND variant_id = :variant_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':variant_id', $variant_id, PDO::PARAM_INT);
        $stmt->execute();
    }
        // CartModel.php
    // CartModel.php
    public function countCartItems($cartId) {
        $sql = "SELECT SUM(quantity) AS total_quantity FROM cart_items WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_quantity'] ?? 0; // Trả về 0 nếu không có sản phẩm
    }



   
    public function updateCartItemQuantityById($cart_id, $cartItemId, $quantity) {
        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $sql = "UPDATE cart_items 
                SET quantity = :quantity
                WHERE cart_id = :cart_id AND id = :cartItemId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->bindParam(':cartItemId', $cartItemId, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    
}


?>
