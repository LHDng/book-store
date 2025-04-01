<?php
    include('../../config.php');
    include('../../model/ctmAccount_model.php');
    if(isset($_SESSION['customer_id'])){

        $customer_id = $_SESSION['customer_id'];
        $db_account="SELECT * FROM customer WHERE customer_id='$customer_id' LIMIT 1";
        $db_account_run = mysqli_query($conn,$db_account);
        if($db_account_run){
            $rs = mysqli_fetch_array($db_account_run);
            $name =$rs['name'];
            $email =$rs['email'];
            $phone_number=$rs['phone'];
            $password = $rs['pass'];
        }else{
            header('location: ../LoginAndSignup/login.php');
            exit(0);
        }

        if(isset($_POST['change-pass-sm'])){
            $oldPass =  mysqli_real_escape_string($conn, $_POST['oldPass']);
            $newPass =  mysqli_real_escape_string($conn, $_POST['newPass']);
            $confirm =  mysqli_real_escape_string($conn, $_POST['confirm']);
            if($oldPass ==  $password){
                if($newPass === $confirm && strlen($newPass) > 2){
                    $update_pass = "UPDATE customer SET pass='$newPass' WHERE customer_id='$customer_id' LIMIT 1";
                    $update_pass_run = mysqli_query($conn, $update_pass);
                    if($update_pass_run){
                        $_SESSION['status'] = "Đổi mật khẩu thành công";
                        header("location: account.php");
                        exit(0);
                    }else{
                        $mess="Something went wrong...";
                    }
                }else{
                    $mess = "Nhập lại mật khẩu mới.";
                }
            }else{
                $mess = "Mật khẩu cũ không đúng.";
            }
        }
        if(isset($_POST['newPhone-sm'])){
            $phone_number=$_POST['newPhone'];
        }
        if(isset($_POST['newEmail-sm'])){
            $email = $_POST['newEmail'];
        }
        if(isset($_POST['change-value-account'])){
            $name = $_POST['name'];
            $phone_number=$_POST['phone'];
            $email = $_POST['email'];
            $mess=checkValid($email,$phone_number);
            if(empty($mess)){
                $update_account = "UPDATE customer SET `name`='$name', phone='$phone_number', email='$email' WHERE customer_id='$customer_id' LIMIT 1";
                $update_account_run = mysqli_query($conn, $update_account);
                if($update_account_run){
                    $_SESSION['status'] = "Đổi thông tin thành công";
                    header("location: account.php");
                    exit(0);
                }else{
                    $mess="Something went wrong...";
                }
            }
        }

        // ##########################################################
        // ##########################################################
        // ##########################################################
        // for address

        $db_account_add="SELECT * FROM `address` WHERE customer_id='$customer_id'";
        $db_account_add_run = mysqli_query($conn,$db_account_add);
        $temp_add_run = mysqli_query($conn,$db_account_add);
        if(!$db_account_add_run){
            header('location: ../LoginAndSignup/home.php');
            exit(0);
        }else{
            while($row = mysqli_fetch_array($db_account_add_run)){
                if($row['is_default'] == 1){
                    $default_add = $row['address'];
                    break;
                }
            }
        }
        // ##########################################################
        // for change address
        $new_address="";
        if(isset($_POST['new-address-sm'])){
            $new_address = $_POST['new-address'];
            if(!empty($new_address)){
                if(strlen($new_address) > 5){
                    $insert_add = "INSERT INTO `address` (address,is_default,customer_id)
                                    VALUES ('$new_address',0,'$customer_id')";
                    $insert_add_run = mysqli_query($conn, $insert_add);
                    if($insert_add_run){
                        $_SESSION['status'] = "Thêm thông tin thành công";
                        header("location: address.php");
                        exit(0);
                    }else{
                        $mess="Something went wrong...";
                    }
                }else{
                    $mess = "Nhập lại địa chỉ.";
                }
                }
                $new_address="";
        }

        if(isset($_POST['change-name-bt'])){
            $_SESSION['status'] = "Thêm thông tin thành công";
        }
        // ##########################################################
        // ##########################################################
        // ##########################################################
        // for oder

        $db_account_oder="SELECT * FROM `oder` WHERE customer_id='$customer_id' AND `status`!='0'";
        $db_account_oder_run = mysqli_query($conn,$db_account_oder);
        if(!$db_account_oder_run){
            header('location: ../LoginAndSignup/home.php');
            exit(0);
        }
    }else{
        header('location: ../LoginAndSignup/login.php');
        exit(0);
    }


?>