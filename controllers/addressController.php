<?php
require_once 'models/addressModel.php';


class addressController {
    private $addressModel;

    public function __construct() {
        $this->addressModel = new addressModel();
    }

    // Phương thức hiển thị form thanh toán
    public function checkout() {
        $user_id = $_SESSION['id'];  // Giả sử bạn đã lưu ID người dùng trong session
        $user_address = $this->addressModel->getAddressByUserId($user_id);
        $cart_items = $this->addressModel->getCartItems($user_id);

        // Truyền dữ liệu vào view checkout
        include 'views/checkout.php';
    }

    // Phương thức xử lý thanh toán
    public function processCheckout() {
        try {
            $user_id = $_SESSION['id'];
            $user_address = $this->addressModel->getAddressByUserId($user_id);
            $cart_items = $this->addressModel->getCartItems($user_id);
            $total_price = 0;

            foreach ($cart_items as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }

            // Bắt đầu giao dịch
            $this->addressModel->beginTransaction();

            // Lưu đơn hàng
            $this->addressModel->saveOrder($user_id, $cart_items, $user_address, $total_price);

            // Xóa giỏ hàng
            $this->addressModel->clearCart($user_id);

            // Commit giao dịch
            $this->addressModel->commit();

            // Redirect hoặc thông báo thành công
            header('Location: index.php?act=home');  // Chuyển đến trang home sau khi hoàn tất
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
    
    
}


?>
