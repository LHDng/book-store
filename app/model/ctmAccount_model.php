<?php
    function checkValid( $email,$newphone){
        $mess ="";
        do{
            if(!is_numeric($newphone) || strlen($newphone) != 10){
                $mess = "Số điện thoại không hợp lệ.";
                break;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mess = "Email không hợp lệ.";
                break;
            }
        }while(false);
        return $mess;
    }
?>