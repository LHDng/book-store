<?php
    include('../config.php');
    if(isset($_GET['delete_id'])){
        $add_id = $_GET['delete_id'];


        $check_add = "SELECT * FROM `oder` WHERE address_id =$add_id ";
        $check_add_run = mysqli_query($conn,$check_add);
        
        if(mysqli_num_rows($check_add_run) > 0){
            $_SESSION['status'] = "Bạn đang sử dụng địa chỉ này. Không thể xóa.";
            header("location: ../views/customer/address.php");
            exit(0);
        }

        $delete_add= "DELETE FROM `address` WHERE address_id =$add_id";
        $delete_add_run = mysqli_query($conn,$delete_add);

        if($delete_add_run){
            $_SESSION['status'] = "Xóa thông tin thành công.";
            header("location: ../views/customer/address.php");
            exit(0);
        }else{
            $_SESSION['status'] = "Something went wrong.";
            header("location: ../views/customer/address.php");
            exit(0);
        }
    }

?>