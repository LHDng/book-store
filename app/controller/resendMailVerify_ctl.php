<?php
    include('../../config.php');
    include('../../model/sendMail_model.php');
    if(isset($_SESSION['customer_id'])){
        header('location: ../customer');
        exit(0);
     }
    $errmess="";
    if(isset($_POST['resendMail_verify'])){
        if(!empty(trim($_POST['email']))){
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $checkemail_query = "SELECT * FROM customer WHERE email='$email' LIMIT 1";
            $checkemail_query_run = mysqli_query($conn,$checkemail_query);
            if(mysqli_num_rows($checkemail_query_run) > 0){
                $row = mysqli_fetch_array($checkemail_query_run);
                if($row['verify_status'] == 0){
                    $email = $row['email'];
                    $code = $row['code'];
                    sendmail_Verify($email, $code);
                    $_SESSION['status'] = "Đã gửi mail xác thực";
                    header("location: ../view/login.php");
                }else{
                    $errmess = "Email đã được xác thực.";
                }
            }else{
                $errmess = "no";
            }
        }else{
            $errmess = "Hãy nhập email.";
        }
    }
?>