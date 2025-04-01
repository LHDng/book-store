<?php
    include('../../config.php');
    include('../../model/checkLogin_model.php');
    if(isset($_SESSION['customer_id'])){
        $customer_id = $_SESSION['customer_id'];

        $db_cart= "SELECT * FROM cart WHERE customer_id='$customer_id'";
        $db_cart_run = mysqli_query($conn,$db_cart);

        if(!$db_cart_run){
            header('location: ../customer/home.php');
            exit(0);
        }
        $number_item = mysqli_num_rows($db_cart_run);


        $db_address = "SELECT * FROM `address` WHERE customer_id='$customer_id'"; 
        $db_address_run = mysqli_query($conn,$db_address);
        if(!$db_address_run){
            header('location: ../customer/home.php');
            exit(0);
        }
        $number_address = mysqli_num_rows($db_address_run);

        if($number_address == 0){
            $_SESSION['status'] = "Bạn cần thêm địa chỉ trước.";
            header('location: ../customer/address.php');
            exit(0);
        }
        $total_price = 0;
        

    }
?>