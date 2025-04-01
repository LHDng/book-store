<?php
    include('../config.php');
    include('../model/sendMail_model.php');
    if(isset($_SESSION['customer_id'])){
        header('location: ../customer');
        exit(0);
     }
    if(isset($_POST['change_pass']))
    {
         $pass = mysqli_real_escape_string($conn, $_POST['pass']);
         $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);

         $code = mysqli_real_escape_string($conn, ($_POST['code']));

        if(!empty($code)){
            if(!empty($pass) || !empty($cpass)){
                $check_code = "SELECT code FROM customer WHERE code='$code'";
                $check_code_run = mysqli_query($conn, $check_code);

                if(mysqli_num_rows($check_code_run) >0){
                    if($pass === $cpass){
                        $update_pass = "UPDATE customer SET pass='$pass' WHERE code='$code' LIMIT 1";
                        $update_pass_run = mysqli_query($conn, $update_pass);
                        if($update_pass_run){
                            $_SESSION['status'] = "Mật khẩu đổi thành công.";
                            header("location: ../views/LoginAndSignup/login.php");
                            exit(0); 
                        }else{
                            $_SESSION['status'] = "Không đổi được mật khẩu. Hãy thử lại.";
                            header("location: ../views/LoginAndSignup/resetPassword.php?code='$code'");
                            exit(0); 
                        }
                    }else{
                        $_SESSION['status'] = "Mật khẩu và xác nhận mật khẩu không giống nhau.";
                        header("location: ../views/LoginAndSignup/resetPassword.php?code=$code");
                        exit(0);
                    }
                }else{
                    $_SESSION['status'] = "No code availabe";
                    header("location: ../views/LoginAndSignup/resetPassword.php?code=$code");
                    exit(0);
                }
            }else{
                $_SESSION['status'] = "No code availabe";
                header("location: ../views/LoginAndSignup/resetPassword.php?code=$code");
                exit(0);
            }
        }else{
            $_SESSION['status'] = "No code availabe";
            header("location: ../views/LoginAndSignup/resetPassword.php");
            exit(0);
        }
    }
?>