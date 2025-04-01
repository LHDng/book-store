<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Sách</a>
         <a href="admin_orders.php">Đơn Hàng</a>
         <a href="admin_users.php">Khách Hàng</a>
         <a href="admin_comments.php">Comment</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>name : <span><?php echo $_SESSION['name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['user_name']; ?></span></p>
         <a href="../php/logout.php" class="delete-btn">logout</a>
      </div>

   </div>

</header>