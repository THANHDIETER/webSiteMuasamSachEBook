<?php
require_once 'connect/function.php';

class addressModel {
     public $conn;
     function __construct() {
         $this->conn = connectDB();
     }

    // Lấy địa chỉ của người dùng
    // public function getAddressByUserId($user_id) {
    //     $query = "SELECT * FROM user_addresses WHERE user_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute([$user_id]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    // Lưu địa chỉ vào DB
    public function saveAddress($user_id, $receiver, $delivery_address, $phone_number, $email) {
        try {
            $query = "INSERT INTO user_addresses (user_id, receiver, delivery_address, phone_number, email)
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$user_id, $receiver, $delivery_address, $phone_number, $email]);
        } catch (PDOException $e) {
            die("Lỗi khi lưu địa chỉ: " . $e->getMessage());
        }
    }
    
    public function getAddressByUserId($user_id) {
        $sql = "SELECT * FROM user_addresses WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về địa chỉ của người dùng
    }
    
    public function clearCart($user_id) {
        try {
            $sql = "DELETE FROM cart WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Lỗi khi xóa giỏ hàng: " . $e->getMessage());
        }
    }
        
    public function getCartItemsByUserId($user_id) {
        $sql = "SELECT * FROM carts WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm
    }
    public function createOrder($user_id, $name, $phone, $address, $email, $payment) {
        // Kiểm tra dữ liệu đầu vào có hợp lệ không
        if (empty($user_id) || empty($name) || empty($phone) || empty($address) || empty($email) || empty($payment)) {
            die("Lỗi: Dữ liệu đơn hàng không hợp lệ.");
        }
        
        try {
            $sql = "INSERT INTO orders (user_id, name, phone, address, email, payment, status) 
                    VALUES (:user_id, :name, :phone, :address, :email, :payment, 'Chờ xác nhận')";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':payment', $payment, PDO::PARAM_STR);
        
            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // Trả về ID đơn hàng mới
            } else {
                return false; // Nếu không thành công
            }
        } catch (PDOException $e) {
            die("Lỗi khi tạo đơn hàng: " . $e->getMessage());
        }
    }
    
    
    // cập nhật trạng thái đơn hàng
    function updateOrderStatus($orderId, $status) {
        // Danh sách trạng thái hợp lệ
        $validStatuses = ['Chờ xác nhận', 'Đã xác nhận', 'Đã huỷ'];
    
        if (!in_array($status, $validStatuses)) {
            die("Trạng thái không hợp lệ.");
        }
    
        // Kiểm tra xem đơn hàng có tồn tại hay không
        $checkOrderSql = "SELECT id FROM orders WHERE id = :order_id";
        $stmt = $this->conn->prepare($checkOrderSql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() === 0) {
            die("Lỗi: Không tìm thấy đơn hàng với ID này.");
        }
    
        // Cập nhật trạng thái đơn hàng
        $sql = "UPDATE orders SET status = :status WHERE id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    

    
}
?>
