<?php
include '../php/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("Location: login.php");
};

//update
if(isset($_POST['update_order'])){
    $order_update_id =$_POST['order_id'];
    $update_status=$_POST['update_status'];
    mysqli_query($conn, "UPDATE `oder` SET status='$update_status'
                         WHERE oder_id = '$order_update_id'")
    or die('query failed');
    $message[]='Trạng Thái Đơn Hàng Đã Được Cập Nhập';

};

//delete
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    mysqli_query($conn, "DELETE FROM `oder` WHERE oder_id='$delete_id'")
    or die('query failed');
    header("Location: admin_orders.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
   <!--front link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--css link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   <?php
    include 'admin_header.php';
   ?>

   <section class="orders">
    <h1 class="title">danh sách đơn hàng</h1>
    <div class="box-container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `oder`")
        or die('query failed');
        if(mysqli_num_rows($select_orders)>0){
            while($fetch_orders= mysqli_fetch_assoc($select_orders)){
                //get customer name
                $select_users_name = mysqli_query($conn, "SELECT * FROM `customer`
                                                              WHERE customer_id = '".$fetch_orders['customer_id']."';")
                or die('query failed');
                $fetch_name=mysqli_fetch_assoc($select_users_name);
        ?>
        <div class="box">
            <p>Mã đơn: <span><?php echo $fetch_orders['oder_id'];?></span></p>
            <p>Khách hàng: <span><?php echo $fetch_name['name'];?></span></p>
            <p>Ngày đặt: <span><?php echo $fetch_orders['oder_date'];?></span></p>
            <p>Tổng đơn: <span><?php echo number_format($fetch_orders['cost'], 0, ',', '.');?>đ</span></p>
            <p>Phương thức thanh toán: <span><?php echo $fetch_orders['payment_method'];?></span></p>
            <p>Trạng thái:</span></p>
            <form action="" method="post">
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['oder_id'];?>">
                <select name="update_status" value="<?php echo $fetch_orders['status'];?>">
                    <option value="" selected disabled><?php
                                                            if($fetch_orders['status']=='1'){
                                                                echo "Đang xử lý";
                                                            }
                                                            if($fetch_orders['status']=='2'){
                                                                echo "Hoàn Thành";
                                                            }
                                                        ?></option>
                    <option value="1"> Đang xử lý</option>
                    <option value="2"> Hoàn thành</option>
                </select>
                <input type="submit" value="cập nhập" name="update_order" class="option-btn">
                <a href="admin_orders.php?delete=<?php echo $fetch_orders['oder_id'];?>"
                onclick="return confirm('Bạn Muốn Xóa Đơn Hàng Này?');"
                class="delete-btn">xóa đơn</a>
            </form>
        
        </div>

        <?php        
            };
        }
        else{
            echo '<p class="empty"> Chưa Có Đơn Hàng Nào Được Đặt!</p>';
        }
        ?>
    </div>
   </section>



    <!-- custom js-->
    <script src="../js/admin_script.js"></script>



</body>
</html>