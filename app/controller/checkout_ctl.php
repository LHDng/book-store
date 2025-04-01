<?php
    include('../config.php');
    include('../model/checkLogin_model.php');
    if(isset($_GET['delete_book']) && isset($_SESSION['customer_id'])){
        $delete_book= "DELETE FROM `cart` WHERE customer_id =$_SESSION[customer_id] AND book_id=$_GET[delete_book]";
        $delete_book_run = mysqli_query($conn,$delete_book);
        if(!$delete_book_run){
            header('location: ../views/LoginAndSignup/login.php');
            exit(0);
        }else{
            header('location: ../views/checkout/cart.php');
            exit(0);
        }
    }
    if(isset($_POST['buy']) && isset($_SESSION['customer_id'])){
        $customer_id = $_SESSION['customer_id'];
        $total_price = $_POST['all-total-price'];
        $payment = mysqli_real_escape_string($conn, $_POST['method-payment']);
        $address_id = $_POST['address'];
        $res=mysqli_fetch_assoc(mysqli_query($conn,"SELECT CURDATE() AS date;"));
        $date=$res['date'];

        $order = "INSERT INTO `oder` (`cost`, `oder_date`, `payment_method`, `customer_id`, `address_id`) 
                  VALUES ('$total_price', '$date', '$payment','$customer_id','$address_id');";
        $order_run = mysqli_query($conn,$order);
        if(!$order_run){
            header('location: ../views/LoginAndSignup/login.php');
            exit(0);
        }

        // for contain

        $get_oder_id = "SELECT oder_id FROM `oder` ORDER BY oder_id DESC LIMIT 1";
        $get_oder_id_run = mysqli_query($conn,$get_oder_id);
        $oder_id = mysqli_fetch_assoc($get_oder_id_run);

        // UPDATE payment

        $get_cart = "SELECT * FROM `cart` WHERE customer_id=$customer_id";
        $get_cart_run = mysqli_query($conn,$get_cart);
        while($row = mysqli_fetch_array($get_cart_run)){
            $contain = "INSERT INTO contain (oder_id,book_id,quantity)
                        VALUES ($oder_id[oder_id] , $row[book_id], $row[quantity])";
            $contain_run = mysqli_query($conn,$contain);
            if(!$contain_run){
                header('location: ../views/LoginAndSignup/login.php');
                exit(0);
            }
        }
        if($order_run && $get_cart_run){
            $_SESSION['status'] = "Mua hành thành công";
            header('location: ../views/customer/order-history.php');
            exit(0);
        }
    }
?>