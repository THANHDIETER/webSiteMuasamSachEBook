<?php

class addressModel {
    public $conn;

    function __construct() {
        $this->conn = connectDB();
    }

    // Lấy sản phẩm trong giỏ hàng
    public function getCartItems($user_id) {
        $sql = "
            SELECT 
                cart_items.*, products.name AS product_name, products.sale,book_variants.format,book_variants.language,book_variants.edition,
                (book_variants.price - (book_variants.price * products.sale / 100)) AS final_price
            FROM cart_items JOIN carts ON cart_items.cart_id = carts.id
            JOIN products ON cart_items.product_id = products.id
            JOIN book_variants ON cart_items.variant_id = book_variants.id
            WHERE carts.user_id = :user_id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getAddressByUserId($user_id) {
        $sql = "SELECT * FROM user_addresses WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về địa chỉ của người dùng
    }

    // Lưu đơn hàng
    public function saveOrder($user_id, $cart_items, $user_address, $total_price, $payment_method,$payment_type, $order_status = 'Chờ xác nhận') {
        try {
            // Kiểm tra nếu các trường thông tin địa chỉ quan trọng là null hoặc rỗng
            if (empty($user_address['receiver']) || empty($user_address['phone_number']) || empty($user_address['delivery_address']) || empty($user_address['email'])) {
                throw new Exception("Thông tin địa chỉ không đầy đủ.");
            }
    
            // Bắt đầu giao dịch
            $this->beginTransaction();
    
            // Xác định trạng thái thanh toán và phương thức thanh toán
            if ($payment_method === 'COD') {
                $payment_status = 'Chưa thanh toán'; // Thanh toán COD chưa thanh toán
                $payment_type = 'COD'; // Phương thức thanh toán là COD
            } elseif ($payment_method === 'VNPAY') {
                $payment_status = 'Đã thanh toán'; // Thanh toán VNPAY đã thanh toán
                $payment_type = 'VNPAY'; // Phương thức thanh toán là VNPAY
            } else {
                throw new Exception("Phương thức thanh toán không hợp lệ.");
            }
    
            // Lưu đơn hàng vào bảng 'orders'
            $sql = "INSERT INTO orders (user_id, name, phone, address, email, total_amount, order_date, status, payment_type, payment) 
                    VALUES (:user_id, :name, :phone, :address, :email, :total_amount, NOW(), :order_status, :payment_type, :payment)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $user_address['receiver'], PDO::PARAM_STR);
            $stmt->bindParam(':phone', $user_address['phone_number'], PDO::PARAM_STR);
            $stmt->bindParam(':address', $user_address['delivery_address'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $user_address['email'], PDO::PARAM_STR);
            $stmt->bindParam(':total_amount', $total_price, PDO::PARAM_STR);
            $stmt->bindParam(':payment', $payment_status, PDO::PARAM_STR); // Trạng thái thanh toán (COD/VNPAY)
            $stmt->bindParam(':order_status', $order_status, PDO::PARAM_STR); // Trạng thái đơn hàng (Chờ xác nhận, Đang giao, v.v.)
            $stmt->bindParam(':payment_type', $payment_type, PDO::PARAM_STR); // Phương thức thanh toán (COD/VNPAY)
    
            $stmt->execute();
    
            // Sau khi lưu đơn hàng, lấy ID của đơn hàng vừa tạo
            $order_id = $this->conn->lastInsertId();
    
            // Lưu chi tiết đơn hàng vào bảng 'order_items'
            foreach ($cart_items as $item) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, total_price, price) 
                        VALUES (:order_id, :product_id, :quantity, :total_price, :price)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
    
                // Tính toán tổng giá trị sản phẩm
                $total_item_price = $item['quantity'] * $item['price']; 
                $stmt->bindParam(':total_price', $total_item_price, PDO::PARAM_STR); 
                $stmt->bindParam(':price', $item['price'], PDO::PARAM_STR);
    
                $stmt->execute();
            }
    
            // Nếu mọi thao tác thành công, commit giao dịch
            $this->commit();
        } catch (Exception $e) {
            // Nếu có lỗi, rollback giao dịch
            $this->rollback();
            throw $e;  // Ném lại lỗi để có thể xử lý ở nơi gọi
        }
    }
    
    
    

    public function insertAddress($user_id, $receiver, $delivery_address, $phone_number, $email) {
        // Kiểm tra nếu địa chỉ của user_id đã tồn tại trong bảng 'user_addresses'
        $sql = "SELECT * FROM user_addresses WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $existingAddress = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingAddress) {
            // Cập nhật nếu địa chỉ đã tồn tại
            $this->updateAddress($user_id, $receiver, $delivery_address, $phone_number, $email);
        } else {
            // Nếu không có, thêm mới
            $stmt = $this->conn->prepare("INSERT INTO user_addresses (user_id, receiver, delivery_address, phone_number, email) 
                                          VALUES (:user_id, :receiver, :delivery_address, :phone_number, :email)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':receiver', $receiver);
            $stmt->bindParam(':delivery_address', $delivery_address);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        }
    }

    public function updateAddress($user_id, $receiver, $delivery_address, $phone_number, $email) {
        $sql = "UPDATE user_addresses SET receiver = :receiver, delivery_address = :delivery_address, 
                phone_number = :phone_number, email = :email WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':receiver', $receiver, PDO::PARAM_STR);
        $stmt->bindParam(':delivery_address', $delivery_address, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Xóa giỏ hàng
    public function clearCart($user_id) {
        $sql = "DELETE FROM cart_items WHERE cart_id IN (SELECT id FROM carts WHERE user_id = :user_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Các phương thức bắt đầu giao dịch, commit và rollback
    public function beginTransaction() {
        if (!$this->conn->inTransaction()) {
            $this->conn->beginTransaction();
        } else {
            error_log("Đã có giao dịch đang hoạt động, không thể bắt đầu giao dịch mới.");
        }
    }

    public function commit() {
        if ($this->conn->inTransaction()) {
            $this->conn->commit();
        } else {
            error_log("Không có giao dịch để commit.");
        }
    }

    public function rollback() {
        if ($this->conn->inTransaction()) {
            $this->conn->rollBack();
        } else {
            error_log("Không có giao dịch để rollback.");
        }
    }
    public function getOrdersByUserId($user_id) {
        // Truy vấn đơn hàng của người dùng, bao gồm loại thanh toán
        $sql = "SELECT id, order_date, total_amount, status, payment_type 
                FROM orders 
                WHERE user_id = :user_id 
                ORDER BY order_date DESC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách đơn hàng cùng loại thanh toán
    }
    

    // Lấy chi tiết đơn hàng
    public function getOrderDetail($order_id, $user_id) {
        // Truy vấn chi tiết đơn hàng
        $sql = "SELECT o.id, o.order_date, o.total_amount, o.status, oi.product_id, oi.quantity, oi.price, p.name, p.img
                FROM orders o
                JOIN order_items oi ON o.id = oi.order_id
                JOIN products p ON oi.product_id = p.id
                WHERE o.id = :order_id AND o.user_id = :user_id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Trả về chi tiết đơn hàng
    }
    public function updateOrderStatus($order_id,$status) {
        $sql = "UPDATE orders SET status = 'Đã hủy' WHERE id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getOrderByIdAndUser($order_id, $user_id) {
        // Truy vấn lấy thông tin đơn hàng dựa trên ID đơn hàng và ID người dùng
        $sql = "SELECT * FROM orders WHERE id = :order_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Nếu tìm thấy đơn hàng, trả về thông tin đơn hàng
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getOrderDetailWithVariants($order_id, $user_id) {
        $sql = "
            SELECT o.id, p.name, p.img, v.format, v.language, v.edition, od.quantity, 
                   (od.price - (od.price * p.sale / 100)) AS price, od.quantity * (od.price - (od.price * p.sale / 100)) AS total_price, o.total_amount
            FROM order_items od
            INNER JOIN orders o ON o.id = od.order_id
            INNER JOIN products p ON p.id = od.product_id
            INNER JOIN book_variants v ON v.id = od.variant_order_id
            WHERE o.id = :order_id AND o.user_id = :user_id";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
