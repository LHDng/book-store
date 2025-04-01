<?php
include '../php/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("Location: login.php");
};

if(isset($_GET['delete_c_id'])&&
   isset($_GET['delete_b_id'])&&
   isset($_GET['delete_cmt'])){
    $delete_c_id = $_GET['delete_c_id'];
    $delete_b_id = $_GET['delete_b_id'];
    $delete_cmt  = $_GET['delete_cmt'];
    mysqli_query($conn, "DELETE FROM `rate`
                        WHERE customer_id = '$delete_c_id' AND
                              book_id     = '$delete_b_id' AND
                              comment     = '$delete_cmt'")
    or die('query failed');
    header("Location: admin_comments.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>
   <!--front link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--css link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   <?php
    include 'admin_header.php';
   ?>

   <section class="messages">
    <h1 class="title">comments</h1>
    <div class="box-container">
        <?php
            $select_comment = mysqli_query($conn, "SELECT * FROM `rate`")
            or die('query failed');
            if(mysqli_num_rows($select_comment)>0){
                while($fetch_comment= mysqli_fetch_assoc($select_comment)){
                    //get customer name
                    $select_users_name = mysqli_query($conn, "SELECT * FROM `customer`
                                                              WHERE customer_id = '".$fetch_comment['customer_id']."';")
                    or die('query failed');
                    $fetch_name=mysqli_fetch_assoc($select_users_name);
                    //get book name
                    $select_book_name = mysqli_query($conn, "SELECT * FROM `book`
                                                              WHERE book_id = '".$fetch_comment['book_id']."';")
                    or die('query failed');
                    $fetch_book=mysqli_fetch_assoc($select_book_name);
        ?>
        <div class="box">
            <p>Khách hàng: <span><?php echo $fetch_name['name']; ?></span> </p>
            <p>Sách: <span><?php echo $fetch_book['name']; ?></span> </p>
            <p>Comment: <span><?php echo $fetch_comment['comment']; ?></span> </p>
            <a href="admin_comments.php?delete_c_id=<?php echo $fetch_comment['customer_id']; ?>&&
                                        delete_b_id=<?php echo $fetch_comment['book_id']; ?>&&
                                        delete_cmt=<?php echo $fetch_comment['comment']; ?>"
                onclick="return confirm('Bạn Muốn Xóa Comment Này?');"
                class="delete-btn">xóa comment</a>
        </div>

        <?php        
            };
        }
        else{
            echo '<p class="empty"> Chưa Có Comment nào!</p>';
        }
        ?>
    </div>
   </section>



    <!-- custom js-->
    <script src="../js/admin_script.js"></script>



</body>
</html>