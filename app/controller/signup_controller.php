<?php

    include('../../config.php');
    include('../../model/signup_model.php');
    include('../../model/sendMail_model.php');
    if(isset($_SESSION['customer_id'])){
        header('location: ../customer');
        exit(0);
     }
    $name ="";
    $email ="";
    $succMess="";
    if(isset($_POST['signup']))
    {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['mail']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
        $code = mysqli_real_escape_string($conn, md5(rand()));
        $mess = checkValid($name, $email, $pass, $cpass, $conn);
        if(empty($mess)){
            $sql = "INSERT INTO customer(name,email,pass,code) VALUES ('$name','$email','$pass','$code')";
            $result = mysqli_query($conn,$sql);
            if($result){
                sendmail_Verify( $email, $code);
                $succMess="Đăng kí thành công. Kiểm tra email để xác thực.";
                $name ="";
                $email ="";
                
            }
        }
    
    }
?>