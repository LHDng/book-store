<?php
    session_start();
    include('../config.php');

    if(isset($_GET['code'])){
        $code = $_GET['code'];
        $sql = "SELECT code, verify_status FROM customer WHERE code='$code' LIMIT 1";
        $verify_run = mysqli_query($conn,$sql);
        if(mysqli_num_rows($verify_run) > 0){
            $row = mysqli_fetch_array($verify_run);
            if($row['verify_status'] == "0"){
                $token = $row['code'];
                $update_query = "UPDATE customer SET verify_status='1' WHERE code='$token' LIMIT 1";
                $update_query_run = mysqli_query($conn,$update_query);
                if($update_query_run){
                    $_SESSION['status'] = "Tài khoản đã được xác thực.";
                    header("Location: ../views/LoginAndSignup/login.php");
                    exit(0);
                }else{
                    $_SESSION['status'] = "Something wrong...";
                    header("Location: ../views/LoginAndSignup/login.php");
                    exit(0);
                }
            }else{
                $_SESSION['status'] = "Tài khoản đã được xác thực. Hãy đăng nhập.";
                header("Location: ../views/LoginAndSignup/login.php");
                exit(0);
            }
        }else{
            $_SESSION['status'] = "Something wrong...";
            header("Location: ../views/LoginAndSignup/login.php");
            exit(0);
        }
    }
?>