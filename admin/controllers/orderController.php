<?php
    
    require_once 'models/orderModel.php';

    // orderController.php
class orderController {
     private $orderModel;
 
     public function __construct() {
         $this->orderModel = new orderModel();
     }
 
    public function adminOrders() {
        $orders = $this->orderModel->getAllOrdersWithStatus(); 
        include './views/order/orders.php'; // Hiển thị danh sách đơn hàng
    }
     // orderController.php
     public function viewOrderDetail() {
        if (!isset($_GET['order_id'])) {
            echo "Không tìm thấy ID đơn hàng.";
            return;
        }
    
        $order_id = $_GET['order_id']; // Lấy ID đơn hàng từ query string
        $order_details = $this->orderModel->getOrderDetailById($order_id); // Lấy thông tin chi tiết đơn hàng
    
        if ($order_details) {
            // Lấy thông tin sản phẩm và tính toán giá
            $processedItems = []; // Mảng xử lý sản phẩm để tránh lặp
            foreach ($order_details['items'] as $item) {
                // Tính giá sau khi giảm giá
                $discounted_price = $item['product_price'] - ($item['product_price'] * $item['sale'] / 100);
                $item['unit_price'] = $discounted_price + $item['variant_price'];
                // Loại bỏ lặp dựa vào product_id và variant_order_id
                $key = $item['product_id'] . '-' . $item['variant_order_id'];
                if (!isset($processedItems[$key])) {
                    $processedItems[$key] = $item;
                }
            }
            $order_details['items'] = array_values($processedItems); // Chuyển lại thành mảng chỉ số tuần tự
            
            include 'views/order/orderDetail.php'; // Hiển thị chi tiết đơn hàng
        } else {
            echo "Không tìm thấy thông tin đơn hàng.";
        }
    }
    
    
    public function shipOrder() {
        if (!isset($_GET['order_id'])) {
            echo "Không tìm thấy ID đơn hàng.";
            return;
        }
        $order_id = $_GET['order_id'];
        $this->orderModel->updateStatus($order_id, 'Đã xác nhận');
        header('Location: ?act=order');
        exit();
    }
    public function cancelOrder() {
        if (!isset($_GET['order_id'])) {
            echo "Không tìm thấy ID đơn hàng.";
            return;
        }
        $order_id = $_GET['order_id'];
        try {
            $this->orderModel->updateShippingStatus($order_id, 'Đã hủy');
            echo "<script type='text/javascript'>
                    alert('Đơn hàng #{$order_id} đã được hủy!');
                    window.location.href = '?act=order';
                  </script>";
            exit();
        } catch (Exception $e) {
            echo "Lỗi khi hủy đơn hàng: " . $e->getMessage();
        }
    }
    
     public function confirmOrder() {
        if (!isset($_GET['order_id'])) {
            echo "Không tìm thấy ID đơn hàng.";
            return;
        }
        $order_id = $_GET['order_id'];
        try {
            $this->orderModel->confirmOrder($order_id);
            echo "alert(Đơn hàng #{$order_id} đã được xác nhận thành công!)";
            echo '<script type="text/javascript">
                   window.location.href = "?act=order"; 
                 </script>';
            exit();
        } catch (Exception $e) {
            echo "Lỗi khi xác nhận đơn hàng: " . $e->getMessage();
        }
    }
    
 }
?>