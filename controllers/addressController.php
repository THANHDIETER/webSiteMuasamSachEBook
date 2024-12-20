<?php
require_once 'models/addressModel.php';
class addressController {
    private $addressModel;
    public function __construct() {
        $this->addressModel = new addressModel();
    }
    public function checkout() {
        $user_id = $_SESSION['id'];  
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
    
            // Tính tổng tiền giỏ hàng
            foreach ($cart_items as $item) {
                $total_price += $item['price'] * $item['quantity'];
            }
           
            // Bắt đầu giao dịch
            $this->addressModel->beginTransaction();
            
            // Kiểm tra phương thức thanh toán và gọi phương thức tương ứng
            if (isset($_POST['payment_method']) && $_POST['payment_method'] === 'COD') {
               
                $this->processCOD($user_id, $cart_items, $user_address, $total_price);
            } else {
                $this->processVNPAY($user_id, $cart_items, $user_address, $total_price);
            } 
        } catch (Exception $e) {
            $this->addressModel->rollback();
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: '" . $e->getMessage() . "',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?act=checkout';
                        }
                    });
                });
            </script>";
        }
    }
    
    public function processCOD($user_id, $cart_items, $user_address, $total_price) {
        try {
            // Thanh toán COD: Lưu đơn hàng và gán trạng thái là "Chưa thanh toán"
            $this->addressModel->saveOrder($user_id, $cart_items, $user_address, $total_price, 'COD', 'Chưa thanh toán', 'Chờ xác nhận');
            $this->addressModel->clearCart($user_id);
            // Commit giao dịch
            $this->addressModel->commit();
            
            // Hiển thị thông báo thành công
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Thanh toán COD thành công!',
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
            $this->addressModel->rollback();
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Lỗi!',
                        text: '" . $e->getMessage() . "',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'index.php?act=checkout';
                        }
                    });
                });
            </script>";
        }
    }
    
    public function processVNPAY($user_id, $cart_items, $user_address, $total_price) {
        try {
            $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
            $vnp_SecureHash = $_GET['vnp_SecureHash'];
            $vnp_HashSecret = "Q110FKS53OSQ688Z7TJ3O0GTKPVHDQDA"; // Đảm bảo secret key chính xác
    
            // Lấy tất cả tham số từ $_GET trừ vnp_SecureHash
            $inputData = array();
            foreach ($_GET as $key => $value) {
                if ($key != 'vnp_SecureHash' && substr($key, 0, 4) === "vnp_") {
                    $inputData[$key] = $value;
                }
            }
    
            ksort($inputData); // Sắp xếp tham số theo thứ tự ABC
            $hashData = urldecode(http_build_query($inputData)); // Tạo chuỗi hash đúng chuẩn
    
            // Tính mã bảo mật
            $calculatedHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
           

            
                
                if ($vnp_ResponseCode === '00') {
                    
                    $this->addressModel->saveOrder($user_id, $cart_items, $user_address, $total_price, 'VNPAY', 'Đã thanh toán', 'Chờ xác nhận');
                    $this->addressModel->clearCart($user_id);
                    $this->addressModel->commit();
                  
                    echo "
                        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    title: 'Thanh toán thành công!',
                                    text: 'Đơn hàng của bạn đã được thanh toán qua VNPAY.',
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
                    
                } else {
                    throw new Exception("Thanh toán thất bại. Mã lỗi: $vnp_ResponseCode");
                }
           
        } catch (Exception $e) {
            $this->addressModel->rollback();
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Lỗi!',
                    text: '" . $e->getMessage() . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'index.php?act=checkout';
                });
            </script>";
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

        require_once 'views/address.php';
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
        
        // Lấy chi tiết đơn hàng và thông tin biến thể
        $orderDetail = $this->addressModel->getOrderDetailWithVariants($order_id, $user_id);
        
        if ($orderDetail) {
            require_once 'views/orderDetail.php'; // Hiển thị chi tiết đơn hàng
        } else {
            echo "<script>alert('Không tìm thấy đơn hàng hoặc bạn không có quyền truy cập.'); window.location.href='index.php?act=order';</script>";
            exit;
        }
    }
    
    public function cancelOrder($orderId) {
        // Ensure the user is logged in
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?act=login");
            exit;
        }
    
        $user_id = $_SESSION['id'];
        $order = $this->addressModel->getOrderByIdAndUser($orderId, $user_id);
        if ($order && $order['status'] == 'Chờ xác nhận') {
            // Proceed to cancel the order
            $this->addressModel->updateOrderStatus($orderId, 'Đã hủy');
            header("Location: index.php?act=order");
        } else {
            echo "<script>alert('Đơn hàng không thể hủy vì không ở trạng thái chờ xác nhận.');</script>";
            header("Location: index.php?act=order");
        }
        exit;
    }
    
}


?>
