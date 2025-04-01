<?php
    include('../config.php'); 
    if(isset($_POST['book_id'])) {
        include('../model/checkLogin_model.php'); 
        $book_id = $_POST['book_id'];
        $customer_id = $_SESSION['customer_id'];
        $quantity = $_POST['quantity'];

        $book = "SELECT * FROM `cart` WHERE book_id=$book_id AND customer_id=$customer_id";
        $book_run = mysqli_query($conn,$book);
        if(mysqli_num_rows($book_run) > 0 ){
            $row = mysqli_fetch_array($book_run);
            $newQuantity = $quantity + $row['quantity'];
            $add_cart = "UPDATE cart SET quantity = $newQuantity WHERE book_id= $book_id AND customer_id=$customer_id";
            $add_cart_run = mysqli_query($conn,$add_cart);
            if(!$add_cart_run){
                header('location: ../customer/home.php');
                exit(0);
            }
        }else{
            $add_cart = "INSERT INTO cart (customer_id,book_id,quantity) VALUE ($customer_id,$book_id,$quantity)";
            $add_cart_run = mysqli_query($conn,$add_cart);
            if(!$add_cart_run){
                header('location: ../customer/home.php');
                exit(0);
            }
        }
    }
    if(isset($_POST['change_quantity'])){
        include('../model/checkLogin_model.php'); 
        $quantity = $_POST['change_quantity'];
        $book_id = $_POST['book_id'];
        $customer_id = $_SESSION['customer_id'];

        $change_quantity = "UPDATE cart SET quantity = $quantity WHERE book_id= $book_id AND customer_id =$customer_id";
        $change_quantity_run = mysqli_query($conn,$change_quantity);
        
        if(!$change_quantity_run){
            header('location: ../customer/home.php');
            exit(0);
        }
    }
?>