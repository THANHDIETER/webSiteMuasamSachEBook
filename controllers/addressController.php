<?php
require_once 'models/cartModel.php';
require_once 'models/addressModel.php';


class addressController {
  
    private $addressModel;

    public function __construct() {
        $this->addressModel = new addressModel();
    }

    // Hiển thị form nhập địa chỉ
    public function address() {
        
        if (!isset($_SESSION['id'])) {
            header('Location: ?act=login');
            exit;
        }
        require_once 'views/address.php';
        // Hiển thị giao diện form
    }

    // Lưu địa chỉ vào cơ sở dữ liệu
    public function saveAddress() {
        session_start();
        $user_id = $_SESSION['id'];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra các trường dữ liệu có tồn tại trong POST hay không
            if (isset($_POST['receiver'], $_POST['delivery_address'], $_POST['phone_number'], $_POST['email'])) {
                $receiver = $_POST['receiver'];
                $delivery_address = $_POST['delivery_address'];
                $phone_number = $_POST['phone_number'];
                $email = $_POST['email'];
    
                // Lưu địa chỉ vào cơ sở dữ liệu
                $this->addressModel->saveAddress($user_id, $receiver, $delivery_address, $phone_number, $email);
    
                // Chuyển hướng về trang giỏ hàng
                header('Location: ?act=cart');
                exit();
            } else {
                die("Lỗi: Dữ liệu địa chỉ không hợp lệ. Vui lòng kiểm tra lại.");
            }
        }
    }
    
    
// Kiểm tra và xử lý mua hàng
public function checkout() {
    // Kiểm tra người dùng đã đăng nhập chưa
    if (!isset($_SESSION['id'])) {
        header('Location: ?act=login');
        exit;
    }

    $user_id = $_SESSION['id'];

    // Kiểm tra địa chỉ
    $addressData = $this->addressModel->getAddressByUserId($user_id);
    if (!$addressData) {
        header('Location: ?act=address');
        exit;
    }

    // Lấy dữ liệu giỏ hàng
    $cartItems = $this->addressModel->getCartItemsByUserId($user_id);
    if (empty($cartItems)) {
        die("Giỏ hàng của bạn đang trống! Vui lòng thêm sản phẩm trước khi thanh toán.");
    }

    // Gán thông tin địa chỉ và thanh toán
    $name = $addressData['receiver'];
    $phone = $addressData['phone_number'];
    $address = $addressData['delivery_address'];
    $email = $addressData['email'];
    $payment = "COD"; // Hoặc có thể lấy từ form thanh toán

    // Tạo đơn hàng mới
    $order_id = $this->addressModel->createOrder($user_id, $name, $phone, $address, $email, $payment);

    if ($order_id) {
        echo "Đơn hàng của bạn đã được tạo thành công. Mã đơn hàng: #" . $order_id;
    } else {
        echo "Lỗi: Không thể tạo đơn hàng. Vui lòng thử lại.";
    }
}


}
