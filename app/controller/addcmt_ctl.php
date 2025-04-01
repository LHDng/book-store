<?php
    include('../config.php');
    if(isset($_POST['comment']) && !empty($_POST['comment']) && isset($_SESSION['customer_id'])){
        $comment = $_POST['comment'];
        $book_id = $_POST['book_id'];

        $cmt = "INSERT INTO `rate` (`customer_id`, `book_id`, `comment`) VALUES ('$_SESSION[customer_id]', '$book_id', '$comment');";
        $cmt_run = mysqli_query($conn,$cmt);
        if(!$cmt_run){
        header('location: ../views/LoginAndSignup/login.php');
        exit(0);
        }
    };
?>