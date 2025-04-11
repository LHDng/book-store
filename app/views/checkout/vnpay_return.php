<?php
session_start();
include('../config.php');
include('../config_vnpay.php');

// Lấy dữ liệu trả về từ VNPay
$vnp_SecureHash = $_GET['vnp_SecureHash'] ?? '';
$inputData = [];

// Ghi log debug toàn bộ dữ liệu trả về
file_put_contents('debug.log', print_r($_GET, true), FILE_APPEND);

foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) === "vnp_") {
        $inputData[$key] = $value;
    }
}
unset($inputData['vnp_SecureHash']);
ksort($inputData);

// Tạo chuỗi hash để kiểm tra tính toàn vẹn
$hashData = urldecode(http_build_query($inputData));
$secureHash = hash_hmac('sha512', $hashData, VNPAY_HASH_SECRET);

// Kiểm tra chữ ký
if (hash_equals($secureHash, $vnp_SecureHash)) {
    $order_id = intval($_GET['vnp_TxnRef']);
    $responseCode = $_GET['vnp_ResponseCode'];

    if ($responseCode === '00') {
        // Cập nhật trạng thái đơn hàng nếu chưa completed
        $stmt = $conn->prepare("UPDATE `oder` SET `status` = 'completed' WHERE `order_id` = ? AND `status` != 'completed'");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();

        // Xoá giỏ hàng nếu người dùng đang đăng nhập
        if (isset($_SESSION['customer_id'])) {
            $customer_id = intval($_SESSION['customer_id']);
            $stmt = $conn->prepare("DELETE FROM `cart` WHERE `customer_id` = ?");
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $stmt->close();
        }

        $_SESSION['status'] = "✅ Thanh toán VNPay thành công!";
    } else {
        // Cập nhật đơn hàng thất bại
        $stmt = $conn->prepare("UPDATE `oder` SET `status` = 'failed' WHERE `order_id` = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['error'] = "❌ Thanh toán VNPay thất bại. Mã lỗi: $responseCode";
    }
} else {
    $_SESSION['error'] = "❌ Chữ ký không hợp lệ – dữ liệu có thể bị thay đổi!";
}

// Ghi log trạng thái
file_put_contents('debug.log', "Đơn hàng: $order_id | Mã phản hồi: $responseCode\n", FILE_APPEND);

// Điều hướng về lịch sử đơn hàng
header('Location: ../views/customer/order-history.php');
exit();
?>
