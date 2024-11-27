
<?php


// Cấu hình thông tin VNPAY
$vnp_TmnCode = "368S4E56"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "Q110FKS53OSQ688Z7TJ3O0GTKPVHDQDA"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/webSiteMuasamSachEBook-DuAn1/index.php?act=processCheckout";

$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

// Thông tin giao dịch

$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
$order_id = time(); // Mã đơn hàng
$vnp_Amount = $_POST['total_price'] * 100;
$vnp_Locale = 'vn';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$vnp_TxnRef = time(); //Mã giao dịch thanh toán tham chiếu của merchant
$vnp_BankCode = 'NCB'; //Mã phương thức thanh toán

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $order_id,
    "vnp_OrderType" => "billpayment",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $order_id
);
if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
header('Location: ' . $vnp_Url);
die();


?>
