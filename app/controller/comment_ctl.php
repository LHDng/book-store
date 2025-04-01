<?php
    include('../../config.php');
    include('../../model/checkLogin_model.php');

    $comment = "SELECT * FROM `rate` WHERE customer_id=$_SESSION[customer_id]";
    $comment_run = mysqli_query($conn,$comment);
    if(!$comment_run){
        header('location: ../views/LoginAndSignup/login.php');
        exit(0);
    }
?>