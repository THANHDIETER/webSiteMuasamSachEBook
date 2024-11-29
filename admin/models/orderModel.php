<?php

class orderModel {
     public $conn;
 
     function __construct() {
         $this->conn = connectDB();
     }
     // orderModel.php
     
     public function getAllOrders() {
        $sql = "SELECT id, name, address, phone, email, total_amount, order_date, payment,
                       payment_type, status 
                FROM orders 
                ORDER BY order_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllOrdersWithStatus() {
        $sql = "SELECT * FROM orders  
                ORDER BY order_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateStatus($order_id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function updateShippingStatus($order_id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
     // orderModel.php
     public function getOrderDetailById($order_id) {
          try {
          $sql = "SELECT * FROM orders WHERE id = :order_id";
          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
          $stmt->execute();
          $order = $stmt->fetch(PDO::FETCH_ASSOC);
          if (!$order) {
               return false;
          }
     
          // Lấy chi tiết các sản phẩm trong đơn hàng
          $sql_items = "SELECT * FROM order_items WHERE order_id = :order_id";
          $stmt = $this->conn->prepare($sql_items);
          $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
          $stmt->execute();
          $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
     
          // Kết hợp thông tin đơn hàng và chi tiết sản phẩm
          $order['items'] = $items;
     
          return $order;
          } catch (Exception $e) {
          throw new Exception("Lỗi khi lấy chi tiết đơn hàng: " . $e->getMessage());
          }
     }
 
     public function confirmOrder($order_id) {
          try {
              // Cập nhật trạng thái đơn hàng và payment
              $sql = "UPDATE orders 
                      SET status = 'đang giao hàng'
                      WHERE id = :order_id";
              $stmt = $this->conn->prepare($sql);
              $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
              $stmt->execute();
          } catch (Exception $e) {
              throw new Exception("Lỗi khi xác nhận đơn hàng: " . $e->getMessage());
          }
      }
      
 }
 
      

?>