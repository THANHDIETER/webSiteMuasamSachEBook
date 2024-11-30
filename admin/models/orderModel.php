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
            // Lấy thông tin đơn hàng
            $sql = "SELECT * FROM orders WHERE id = :order_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->execute();
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$order) {
                return false;
            }
    
            // Lấy chi tiết các sản phẩm trong đơn hàng và thông tin biến thể
            $sql_items = "
            SELECT oi.*,p.price AS product_price, p.sale, p.name AS product_name, bv.format, bv.language, bv.edition, bv.price AS variant_price
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            LEFT JOIN book_variants bv ON oi.variant_order_id = bv.id
            WHERE oi.order_id = :order_id
        ";
        
            $stmt = $this->conn->prepare($sql_items);
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Kiểm tra nếu không có sản phẩm trong đơn hàng
            if (empty($items)) {
                throw new Exception("Không có sản phẩm trong đơn hàng này.");
            }
    
            // Kết hợp thông tin đơn hàng và chi tiết sản phẩm (bao gồm cả biến thể)
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
      public function getReportData() {
        try {
            // Tổng số đơn hàng
            $orderCountQuery = "SELECT COUNT(*) as total_orders FROM orders";
            $stmt = $this->conn->query($orderCountQuery);
            $totalOrders = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];

            // Tổng doanh thu
            $revenueQuery = "SELECT SUM(total_amount) as total_revenue FROM orders WHERE status = 'Đã xác nhận'";
            $stmt = $this->conn->query($revenueQuery);
            $totalRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];

            // Tổng số sản phẩm đã bán
            $productSoldQuery = "SELECT SUM(quantity) as total_products_sold FROM order_items";
            $stmt = $this->conn->query($productSoldQuery);
            $totalProductsSold = $stmt->fetch(PDO::FETCH_ASSOC)['total_products_sold'];

            return [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_products_sold' => $totalProductsSold
            ];
        } catch (Exception $e) {
            throw new Exception("Lỗi khi truy xuất dữ liệu báo cáo: " . $e->getMessage());
        }
    }
      
 }
 
      

?>