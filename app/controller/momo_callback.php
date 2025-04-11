<?php
session_start();
include('../config.php');
include('../config_momo.php');

// Nhận dữ liệu từ Momo
$data = $_POST;
$signature = $data['signature'];
unset($data['signature']);

// Xác minh chữ ký
$rawHash = "accessKey=" . MOMO_ACCESS_KEY .
           "&amount=" . $data['amount'] .
           "&extraData=" . $data['extraData'] .
           "&message=" . $data['message'] .
           "&orderId=" . $data['orderId'] .
           "&orderInfo=" . $data['orderInfo'] .
           "&orderType=" . $data['orderType'] .
           "&partnerCode=" . $data['partnerCode'] .
           "&payType=" . $data['payType'] .
           "&requestId=" . $data['requestId'] .
           "&responseTime=" . $data['responseTime'] .
           "&resultCode=" . $data['resultCode'] .
           "&transId=" . $data['transId'];

$computedSignature = hash_hmac("sha256", $rawHash, MOMO_SECRET_KEY);

if ($computedSignature === $signature) {
    if ($data['resultCode'] == 0) {
        // Thanh toán thành công
        $order_id = $data['orderId'];
        
        // Cập nhật CSDL
        $update = "UPDATE `oder` SET `status` = 'completed' WHERE `order_id` = $order_id";
        mysqli_query($conn, $update);
        
        // Xóa giỏ hàng
        $customer_id = $_SESSION['customer_id'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE `customer_id` = $customer_id");
        
        $_SESSION['status'] = "Thanh toán Momo thành công!";
    } else {
        $_SESSION['error'] = "Thanh toán Momo thất bại: " . $data['message'];
    }
} else {
    $_SESSION['error'] = "Chữ ký không hợp lệ";
}

header('Location: ../views/customer/order-history.php');
?>