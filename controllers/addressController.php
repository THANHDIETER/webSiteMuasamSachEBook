<?php
require_once 'models/addressModel.php';
class addressController {
    private $addressModel;
    public function __construct() {
        $this->addressModel = new addressModel();
    }
    public function checkout() {
        $user_id = $_SESSION['id'];  // Giả sử bạn đã lưu ID người dùng trong session
        $user_address = $this->addressModel->getAddressByUserId($user_id);
        $cart_items = $this->addressModel->getCartItems($user_id);
        include 'views/checkout.php';
    }
    public function processCheckout() {
        try {
            $user_id = $_SESSION['id'];
            $user_address = $this->addressModel->getAddressByUserId($user_id);
            $cart_items = $this->addressModel->getCartItems($user_id);
            $total_price = 0;

            foreach ($cart_items as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }
            $this->addressModel->beginTransaction();
            $this->addressModel->saveOrder($user_id, $cart_items, $user_address, $total_price);
            $this->addressModel->clearCart($user_id);
            $this->addressModel->commit();
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Cảm ơn bạn đã mua hàng!',
                        text: 'Sản phẩm sẽ được giao đến bạn trong thời gian gần nhất.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?act=home';
                        }
                    });
                });
            </script>";
        

        } catch (Exception $e) {
            // Nếu có lỗi, rollback giao dịch
            $this->addressModel->rollback();
            echo "Lỗi trong quá trình thanh toán: " . $e->getMessage();
        }
    }

    // Phương thức hiển thị form cập nhật địa chỉ
    public function updateAddress() {
        if (!isset($_SESSION['id'])) {
            header('Location: ?act=login');
            exit();
        }

        $user_id = $_SESSION['id']; // Lấy ID người dùng từ session

        if (isset($_POST['receiver'], $_POST['delivery_address'], $_POST['phone_number'], $_POST['email'])) {
            $receiver = $_POST['receiver'];
            $delivery_address = $_POST['delivery_address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];

            // Kiểm tra xem địa chỉ đã tồn tại hay chưa
            $user_address = $this->addressModel->getAddressByUserId($user_id);

            if ($user_address) {
                // Nếu địa chỉ đã tồn tại, cập nhật
                $this->addressModel->updateAddress($user_id, $receiver, $delivery_address, $phone_number, $email);
            } else {
                // Nếu địa chỉ chưa tồn tại, thêm mới
                $this->addressModel->insertAddress($user_id, $receiver, $delivery_address, $phone_number, $email);
            }

            header('Location: ?act=checkout');
            exit();
        }

        require_once 'views/address.php'; // Tải view để nhập địa chỉ
    }
    public function showOrder() {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id']; // Lấy ID người dùng từ session
        
        // Lấy danh sách đơn hàng từ model
        $orders = $this->addressModel->getOrdersByUserId($user_id);
    
        // Truyền danh sách đơn hàng vào view
        require_once 'views/order.php';
        return $orders;  // Trả về danh sách đơn hàng (nếu cần sử dụng sau này)
    }
    

    // Phương thức để xem chi tiết đơn hàng
    public function viewOrderDetail($order_id) {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }

        $user_id = $_SESSION['id'];
        
        // Lấy chi tiết đơn hàng từ model
        $orderDetail = $this->addressModel->getOrderDetail($order_id, $user_id);

        if ($orderDetail) {
            require_once 'views/orderDetail.php'; // Hiển thị chi tiết đơn hàng
        } else {
            echo "Không tìm thấy đơn hàng.";
        }
    }
    public function cancelOrder($orderId) {
        // Ensure the user is logged in
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id'];
    
        // Get the order by ID and user ID
        $order = $this->addressModel->getOrderByIdAndUser($orderId, $user_id);
    
        // Check if the order exists and if its status is "Chờ xác nhận"
        if ($order && $order['status'] == 'Chờ xác nhận') {
            // Proceed to cancel the order
            $this->addressModel->updateOrderStatus($orderId, 'Đã huỷ');
            header("Location: index.php?act=order");
        } else {
            echo "<script>alert('Đơn hàng không thể hủy vì không ở trạng thái chờ xác nhận.');</script>";
            header("Location: index.php?act=order");
        }
        exit;
    }
    
}


?>
