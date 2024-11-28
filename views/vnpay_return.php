<?php
// vnpay_return.php
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$vnp_Params = $_GET;
unset($vnp_Params['vnp_SecureHash']); // Loại bỏ SecureHash ra khỏi params

// Tạo mã hash và so sánh với mã hash trả về từ VNPAY
$secureHash = hash_hmac('sha512', http_build_query($vnp_Params), "YOUR_SECRET_KEY");

if ($secureHash === $vnp_SecureHash) {
    // Kiểm tra trạng thái thanh toán (vnp_ResponseCode = 00 thì thành công)
    if ($_GET['vnp_ResponseCode'] === "00") {
        echo "Thanh toán thành công!";
        // Xử lý cập nhật đơn hàng và thông báo cho khách hàng
    } else {
        echo "Thanh toán không thành công!";
    }
} else {
    echo "Dữ liệu không hợp lệ!";
}
?>
