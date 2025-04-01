<?php
     if(!isset($_SESSION['customer_id'])){
        header('location: ../LoginAndSignup/login.php');
        exit(0);
     }
?>