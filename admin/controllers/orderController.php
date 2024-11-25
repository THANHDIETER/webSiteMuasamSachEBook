<?php
    
    require_once 'models/orderModel.php'; // Đảm bảo nạp đúng file của orderModel
    require_once 'models/addressModel.php'; // Thêm dòng này để nạp addressModel
    

class orderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new orderModel();
    }
    public function confirmOrder() {
     if (!isset($_GET['order_id'])) {
         echo "Không tìm thấy ID đơn hàng.";
         return;
     }
 
     $order_id = $_GET['order_id']; // Lấy ID đơn hàng từ query string
     $model = new addressModel();
 
     try {
         $model->confirmOrder($order_id); // Xác nhận đơn hàng
         echo "Đơn hàng #{$order_id} đã được xác nhận thành công!";
         header('Location: ?act=order'); // Chuyển hướng về trang danh sách đơn hàng Admin
     } catch (Exception $e) {
         echo "Lỗi: " . $e->getMessage();
     }
 }
}
?>