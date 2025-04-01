<?php
include '../php/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("Location: login.php");
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    //Check foreign key
    $check_user= mysqli_query($conn, "SELECT * FROM `oder` WHERE customer_id='$delete_id'") 
    or die('query failed');
    if(mysqli_num_rows($check_user)>0){
        echo '
      <div class="message">
         <span>Không Thể Xóa Do Ràng Buộc Khóa!</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      header("Refresh:2; url=http://localhost/Assignment/online-bookstore/app/admin/view/admin_users.php", true, 303);
    }
    else{
        mysqli_query($conn, "DELETE FROM `customer`
                        WHERE customer_id = '$delete_id'")
        or die('query failed');
        header("Location: admin_users.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
   <!--front link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--css link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   <?php
    include 'admin_header.php';
   ?>

    <section class="users">
        <h1 class="title">users accounts</h1>
        <div class="box-container">
            <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `customer`")
                or die('query failed');
                if(mysqli_num_rows($select_users)>0){
                    while($fetch_users= mysqli_fetch_assoc($select_users)){
            ?>
            <div class="box">
                <p>Tên: <span><?php echo $fetch_users['name'];?></span></p>
                <p>Email: <span><?php echo $fetch_users['email'];?></span></p>
                <p>Điện thoại: <span><?php echo $fetch_users['phone'];?></span></p>
                <a href="admin_users.php?delete=<?php echo $fetch_users['customer_id']; ?>"
                onclick="return confirm('Bạn Muốn Xóa User Này?');"
                class="delete-btn">xóa user</a>
            
            </div>
            <?php        
                };
            }
            else{
                echo '<p class="empty"> Chưa Có User Nào Trong Cơ Sở Dữ Liệu!</p>';
            }
            ?>
        </div>
    </section>

    <!-- custom js-->
    <script src="../js/admin_script.js"></script>



</body>
</html>