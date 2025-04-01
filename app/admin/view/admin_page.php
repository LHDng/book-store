<?php
include '../php/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("Location: login.php");
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
   <!--front link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--css link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   <?php
    include 'admin_header.php';
   ?>

    <!-- adimin dashboard section starts -->
    <section class="dashboard">
        <h1 class="title">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <?php
                    $total_pendings=0;
                    $select_pending = mysqli_query($conn, "SELECT cost FROM `oder`
                                                            WHERE  status ='1'")
                                    or die('query failed');
                    
                    if(mysqli_num_rows($select_pending)>0){
                        while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                            $cost = $fetch_pendings['cost'];
                            $total_pendings += $cost;
                        };
                    };
                    
                ?>
                <h3><?php echo number_format($total_pendings, 0, ',', '.');?>đ</h3>
                <p>Tổng Giá Trị Đơn Chờ</p>
            </div>

            <div class="box">
                <?php
                    $total_complited=0;
                    $select_complited = mysqli_query($conn, "SELECT cost FROM `oder`
                                                            WHERE  status ='2'")
                                    or die('query failed');
                    
                    if(mysqli_num_rows($select_complited)>0){
                        while($fetch_complited = mysqli_fetch_assoc($select_complited)){
                            $cost = $fetch_complited['cost'];
                            $total_complited += $cost;
                        };
                    };
                    
                ?>
                <h3><?php echo number_format($total_complited, 0, ',', '.');?>đ</h3>
                <p>Tổng Giá Trị Đơn Hoàn Thành</p>
            </div>

            <div class="box">
                <?php
                    $seclect_oders = mysqli_query($conn, "SELECT * FROM `oder`")
                                     or die('query failed');
                    $number_of_oders = mysqli_num_rows($seclect_oders);
                ?>
                <h3><?php echo $number_of_oders?></h3>
                <p>Tổng Số Đơn</p>
            </div>

            <div class="box">
                <?php
                    $seclect_books = mysqli_query($conn, "SELECT * FROM `book`")
                                     or die('query failed');
                    $number_of_books = mysqli_num_rows($seclect_books);
                ?>
                <h3><?php echo $number_of_books?></h3>
                <p>Tổng Số Sách</p>
            </div>

            <div class="box">
                <?php
                    $seclect_customers = mysqli_query($conn, "SELECT * FROM `customer`")
                                     or die('query failed');
                    $number_of_customers = mysqli_num_rows($seclect_customers);
                ?>
                <h3><?php echo $number_of_customers?></h3>
                <p>Số Người Dùng</p>
            </div>

            <div class="box">
                <?php
                    $seclect_comment = mysqli_query($conn, "SELECT * FROM `rate`")
                                     or die('query failed');
                    $number_of_comment = mysqli_num_rows($seclect_comment);
                ?>
                <h3><?php echo $number_of_comment?></h3>
                <p>Số Nhận Xét</p>
            </div>
        </div>

    </section>
    <!-- adimin dashboard section ends -->

    <!-- custom js-->
    <script src="../js/admin_script.js"></script>



</body>
</html>