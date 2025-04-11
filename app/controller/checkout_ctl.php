<?php
include('../config.php');
include('../model/checkLogin_model.php');
include('../config_momo.php');
include('../config_vnpay.php');

//Xóa khỏi giỏ hàng
if (isset($_GET['delete_book']) && isset($_SESSION['customer_id'])) {
    $delete_book = "DELETE FROM `cart` WHERE customer_id =$_SESSION[customer_id] AND book_id=$_GET[delete_book]";
    $delete_book_run = mysqli_query($conn, $delete_book);
    if (!$delete_book_run) {
        header('location: ../views/LoginAndSignup/login.php');
        exit(0);
    } else {
        header('location: ../views/checkout/cart.php');
        exit(0);
    }
}
//thanh toán đơn hàng
if (isset($_POST['buy']) && isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $total_price = $_POST['all-total-price'];
    $payment = mysqli_real_escape_string($conn, $_POST['method-payment']);
    $address_id = $_POST['address'];
    $res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT CURDATE() AS date;"));
    $date = $res['date'];

    $status = ($payment == 'cash') ? 'processing' : 'pending';
    $order = "INSERT INTO `oder` (`cost`, `oder_date`, `payment_method`, `customer_id`, `address_id`, `status`) 
              VALUES ('$total_price', '$date', '$payment', '$customer_id', '$address_id', '$status')";
    $order_run = mysqli_query($conn, $order);

    if (!$order_run) {
        header('location: ../views/LoginAndSignup/login.php');
        exit(0);
    }

    //Thêm vào csdl
    $get_oder_id = "SELECT order_id FROM `oder` ORDER BY order_id DESC LIMIT 1";
    $get_oder_id_run = mysqli_query($conn, $get_oder_id);
    $oder_id = mysqli_fetch_assoc($get_oder_id_run);

    // Chi tiết đơn hàng
    $get_cart = "SELECT * FROM `cart` WHERE customer_id=$customer_id";
    $get_cart_run = mysqli_query($conn, $get_cart);
    while ($row = mysqli_fetch_array($get_cart_run)) {
        $contain = "INSERT INTO contain (order_id,book_id,quantity)
                        VALUES ($oder_id[order_id] , $row[book_id], $row[quantity])";
        $contain_run = mysqli_query($conn, $contain);
        if (!$contain_run) {
            header('location: ../views/LoginAndSignup/login.php');
            exit(0);
        }
    }


      // Xử lý thanh toán online
    if($payment == 'momo') {
        $result = processMomoPayment(
            $oder_id['order_id'],
            $total_price,
            "Thanh toán đơn hàng sách #".$oder_id['order_id'],
            "http://yourdomain.com/views/customer/order-history.php",
            "http://yourdomain.com/momo_callback.php"
        );
        
        if($result['resultCode'] == 0) {
            header('Location: '.$result['payUrl']);
            exit();
        } else {
            $_SESSION['error'] = "Lỗi kết nối với Momo";
            header('location: ../views/checkout/cart.php');
            exit(0);
        }
    }
    elseif($payment == 'vnpay') {
        $paymentUrl = processVNPayPayment(
            $oder_id['order_id'],
            $total_price,
            "Thanh toán đơn hàng sách #".$oder_id['order_id']
        );
        header('Location: '.$paymentUrl);
        exit();
    }
    
    // Nếu là thanh toán tiền mặt
    if($payment == 'cash') {
        // Xóa giỏ hàng sau khi thanh toán thành công
        mysqli_query($conn, "DELETE FROM `cart` WHERE customer_id = $customer_id");
        $_SESSION['status'] = "Mua hàng thành công! Đơn hàng đang được xử lý.";
        header('location: ../views/customer/order-history.php');
        exit(0);
    }
}
?>