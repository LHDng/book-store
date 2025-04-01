<?php
    include('../../config.php');
    include('../../model/sendMail_model.php');

    $mess ="";
    if(isset($_POST['pass_reset_link'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $newcode = md5(rand());

        $check_email = "SELECT email FROM customer WHERE email='$email' LIMIT 1";
        $check_email_run = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($check_email_run) > 0){
            $row = mysqli_fetch_array($check_email_run);
            $get_email = $row['email'];

            $update_code = "UPDATE customer SET code='$newcode' WHERE email='$get_email' LIMIT 1";
            $update_code_run = mysqli_query($conn,$update_code);

            if($update_code_run){
                sendmail_pass_reset($email,$newcode);
                $_SESSION['status'] = "Đã gửi link xác nhận mật khẩu";
                header('location: login.php');
            }else{
                $mess = "Something went wrong..";
            }
        }else{
            $mess = "Hãy nhập lại email.";
        }
    }
?>