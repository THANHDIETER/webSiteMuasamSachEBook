<?php
    
    require_once 'models/orderModel.php';

    // orderController.php
class orderController {
     private $orderModel;
 
     public function __construct() {
         $this->orderModel = new orderModel();
     }
 
     // Hiển thị danh sách đơn hàng trong admin
     public function adminOrders() {
         $orders = $this->orderModel->getAllOrders(); // Lấy tất cả đơn hàng
         include './views/order/orders.php'; // Hiển thị danh sách đơn hàng
     }
     // orderController.php
     public function viewOrderDetail() {
     // Kiểm tra nếu có 'order_id' được truyền trong URL
     if (!isset($_GET['order_id'])) {
         echo "Không tìm thấy ID đơn hàng.";
         return;
     }
 
     // Lấy ID đơn hàng từ query string
     $order_id = $_GET['order_id'];
 
     // Gọi model để lấy thông tin chi tiết đơn hàng
     $orderModel = new orderModel();
     $order_details = $orderModel->getOrderDetailById($order_id);
 
     if ($order_details) {
         // Chuyển đến view chi tiết đơn hàng và truyền dữ liệu
         include 'views/order/orderDetail.php';
     } else {
         echo "Không tìm thấy thông tin đơn hàng.";
     }
 }
 
     // Xác nhận đơn hàng
     public function confirmOrder() {
         if (!isset($_GET['order_id'])) {
             echo "Không tìm thấy ID đơn hàng.";
             return;
         }
 
         $order_id = $_GET['order_id']; // Lấy ID đơn hàng từ query string
 
         try {
             $this->orderModel->confirmOrder($order_id); // Gọi phương thức xác nhận đơn hàng
             echo "Đơn hàng #{$order_id} đã được xác nhận thành công!";
             echo '<script type="text/javascript">
                    window.location.href = "?act=order";
                     
                </script>'; // Chuyển hướng về trang danh sách đơn hàng Admin
             exit();
         } catch (Exception $e) {
             echo "Lỗi khi xác nhận đơn hàng: " . $e->getMessage();
         }
     }
 }
 
    

?>