<?php

define('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
define('VNPAY_TMN_CODE', 'DEMOVN123');
define('VNPAY_HASH_SECRET', 'KJASHDFKJ23423KJHKJH2342KJ3');
define('VNPAY_RETURN_URL', 'http://localhost:8000/book-store/app/views/checkout/vnpay_return.php');

// Hàm xử lý thanh toán VNPay
function processVNPayPayment($order_id, $amount, $order_desc) {
    date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đảm bảo giờ đúng
    $vnp_TmnCode = VNPAY_TMN_CODE; 
    $vnp_HashSecret = VNPAY_HASH_SECRET;
    $vnp_Url = VNPAY_URL;
    $vnp_Returnurl = VNPAY_RETURN_URL;

    $vnp_TxnRef = $order_id;
    $vnp_OrderInfo = $order_desc;
    $vnp_OrderType = "book";
    $vnp_Amount = $amount * 100;
    $vnp_Locale = "vn";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_CreateDate = date('YmdHis');
    $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes')); // hết hạn sau 15 phút

    // Thêm 'vnp_ExpireDate' vào inputData
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => $vnp_CreateDate,
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $vnp_ExpireDate
    );

    ksort($inputData);
    $hashdata = "";
    $query = "";
    foreach ($inputData as $key => $value) {
        $hashdata .= $key . "=" . $value . '&';
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $hashdata = rtrim($hashdata, '&');
    $query = rtrim($query, '&');

    $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnp_SecureHash;

    // Chuyển hướng người dùng đến VNPay
    header('Location: ' . $vnp_Url);
    exit;
}

?>
