<?php

class addressModel {
    public $conn;

    function __construct() {
        $this->conn = connectDB();
    }

    // Lấy sản phẩm trong giỏ hàng
    public function getCartItems($user_id) {
        $sql = "SELECT cart_items.*, products.name AS product_name, products.price 
                FROM cart_items
                JOIN carts ON cart_items.cart_id = carts.id
                JOIN products ON cart_items.product_id = products.id
                WHERE carts.user_id = :user_id"; // Sử dụng carts.user_id thay vì cart_items.user_id
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
        public function saveOrder($user_id, $cart_items, $user_address, $total_price) {
            try {
                // Kiểm tra nếu name hoặc các trường quan trọng khác là null
                if (empty($user_address['receiver']) || empty($user_address['phone_number']) || empty($user_address['delivery_address']) || empty($user_address['email'])) {
                    throw new Exception("Thông tin địa chỉ không đầy đủ.");
                }
        
                // Bắt đầu giao dịch
                $this->beginTransaction();
        
                // Lưu đơn hàng vào bảng 'orders'
                $sql = "INSERT INTO orders (user_id, name, phone, address, email, total_amount, order_date, status, payment) 
                 VALUES (:user_id, :name, :phone, :address, :email, :total_amount, NOW(), 'Chờ xác nhận', :payment)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindParam(':name', $user_address['receiver'], PDO::PARAM_STR);
                $stmt->bindParam(':phone', $user_address['phone_number'], PDO::PARAM_STR);
                $stmt->bindParam(':address', $user_address['delivery_address'], PDO::PARAM_STR);
                $stmt->bindParam(':email', $user_address['email'], PDO::PARAM_STR);
                $stmt->bindParam(':total_amount', $total_price, PDO::PARAM_STR);

                // Thêm giá trị cho payment
                $payment = 'Chưa thanh toán'; // Bạn có thể thay đổi giá trị mặc định nếu cần
                $stmt->bindParam(':payment', $payment, PDO::PARAM_STR);

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
                    $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);$total_item_price = $item['quantity'] * $item['price']; // Tạo biến trung gian
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
        // Truy vấn đơn hàng của người dùng
        $sql = "SELECT id, order_date, total_amount, status FROM orders WHERE user_id = :user_id ORDER BY order_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách đơn hàng
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
    public function updateOrderStatus($order_id) {
        $sql = "UPDATE orders SET status = 'Đã huỷ' WHERE id = :order_id";
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
    
}
?>
