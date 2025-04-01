<?php
include('../../config.php');
 if(isset($_SESSION['customer_id'])){
    header('location: ../customer/home.php');
    exit(0);
 }
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $sql = "SELECT * FROM customer WHERE email='$email'AND pass='$pass'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['verify_status'] == 1){
            $_SESSION['customer_id'] = $row['customer_id'];
            $id = $row['customer_id'];
            header("location: ../customer/home.php");
        }else{
            $_SESSION['status'] = "Email chưa xác thực.";
        }
    }else{
        $_SESSION['status'] = "Email hoặc mật khẩu không hợp lệ.";
    }
}
?>