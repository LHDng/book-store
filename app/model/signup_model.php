<?php


function checkValid($name, $email, $pass, $cpass, $conn){
    $mess="";
    do{
        if(strlen($name) <= 2 ||strlen($name) >= 50 ){
            $mess = "Hãy điền tên của bạn.";
            break;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mess = "Email không hợp lệ.";
            break;
        }
        if(!($pass===$cpass)){
            $mess ="Các mật khẩu đã nhập không khớp. Hãy thử lại.";
            break;
        }
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customer WHERE email='$email'")) > 0){
            $mess ="Email đã được đăng kí";
            break;
        }
    
    }while(false);

    return $mess;
}

?>