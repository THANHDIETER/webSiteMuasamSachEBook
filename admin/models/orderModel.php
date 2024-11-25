<?php

class orderModel {
     public $conn;
 
     function __construct() {
         $this->conn = connectDB();
     }
    public function confirmOrder($order_id, $status = 'Đã xác nhận') {
     $valid_statuses = ['Chờ xác nhận', 'Đã xác nhận', 'Đã huỷ'];
     if (!in_array($status, $valid_statuses)) {
         throw new Exception("Trạng thái không hợp lệ.");
     }
 
     $sql = "UPDATE orders SET status = :status WHERE id = :order_id";
     $stmt = $this->conn->prepare($sql);
     $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
     $stmt->bindParam(':status', $status, PDO::PARAM_STR);
     $stmt->execute();
 }
 
     public function getAllOrders() {
     $sql = "SELECT * FROM orders ORDER BY order_date DESC";
     $stmt = $this->conn->prepare($sql);
     $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }
}
?>