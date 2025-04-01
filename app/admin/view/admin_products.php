<?php
include '../php/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("Location: login.php");
};


// add
if(isset($_POST['add_book'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $categogy_id=$_POST['categogy'];
    $price = $_POST['price'];
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $cover_image = mysqli_real_escape_string($conn, $_POST['cover_image']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $seclect_product_name = mysqli_query($conn, "SELECT name FROM `book`
                                                WHERE name = '$name'")
    or die('query faile');

    if(mysqli_num_rows($seclect_product_name)>0){
        $message[]="Tên Sách Đã Tồn Tại!";

    }
    else{
        $add_book_query = mysqli_query($conn,"INSERT INTO `book` (`book_id`, `name`, `description`, `price`, `author`, `publisher`, `cover_image`, `category_id`)
                                             VALUES (NULL, '$name', '$description', '$price', '$author', '$publisher', '$cover_image', '$categogy_id');" )
        or die('query failed');

        if($add_book_query){
            $message[]="Thêm Sách Thành Công!";
        }
        else{
            $message[]="Không Thể Thêm";
        }
        
    }

}

// delete
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    //check foreign key
    $check_book= mysqli_query($conn, "SELECT * FROM `contain` WHERE book_id='$delete_id'") 
    or die('query failed');
    if(mysqli_num_rows($check_book)>0){
        echo '
      <div class="message">
         <span>Không Thể Xóa Do Ràng Buộc Khóa!</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      header("Refresh:2; url=http://localhost/Assignment/online-bookstore/app/admin/view/admin_products.php", true, 303);
    }
    else{
        mysqli_query($conn, "DELETE FROM `book` WHERE book_id='$delete_id'") 
        or die('query failed');
        header("Location: admin_products.php");
    }
}

// update
if(isset($_POST['update_book'])){
    $update_id          = $_POST['update_p__id'];
    $update_name        = mysqli_real_escape_string($conn,$_POST['update_name']);
    $update_price       = $_POST['update_price'];
    $update_author      = mysqli_real_escape_string($conn,$_POST['update_author']);
    $update_publisher   = mysqli_real_escape_string($conn,$_POST['update_publisher']);
    $update_categogy    = $_POST['update_categogy'];
    $update_cover_image = $_POST['update_cover_image'];
    $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);

    mysqli_query($conn,"UPDATE `book` 
                        SET `name`    = '$update_name', 
                        `description` = '$update_description', 
                        `price`       = '$update_price', 
                        `author`      = '$update_author', 
                        `publisher`   = '$update_publisher', 
                        `cover_image` = '$update_cover_image', 
                        `category_id` = '$update_categogy' 
                        WHERE `book`.`book_id` = '$update_id';")
    or die('query failed');

    header("Location: admin_products.php");


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
   <!--front link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!--css link-->
    <link rel="stylesheet" href="../css/admin_style.css">





</head>
<body>
   <?php
    include 'admin_header.php';
   ?>
    <!-- produc CRUD section starts -->
    <section class="add-products">

        <h1 class="title">quản lý sách</h1>
        <form action="" method="post">
            <h3>thêm sách</h3>
            
            <input type="text" class="box" name="name" placeholder="Nhập Tên Sách" required>
            <select class="box" name="categogy" value= "chon the loai">
                <?php
                    $categogys = mysqli_query($conn, "SELECT * FROM `categogy`")
                    or die ('query failed');
                    while($categogy = mysqli_fetch_assoc($categogys)){
                        echo '<option value="'.$categogy['category_id'].'">'.$categogy['name'].'</option>';
                    };
                ?>
                
            </select>
            <input type="number" min="0" class="box" name="price" placeholder="Nhập Giá Sách" required>
            <input type="text" class="box" name="author" placeholder="Nhập Tên Tác Giả" required>
            <input type="text" class="box" name="publisher" placeholder="Nhập Tên Nhà Xuất Bản" required>
            <input type="text" class="box" name="cover_image" placeholder="Nhập Link Ảnh" required>
            <textarea rows="3" class="box" name="description" placeholder="Nhập Giới Thiệu" required></textarea>
        
            <input type="submit" name="add_book" value="thêm sách" class="btn">
        
        </form>

    </section>
    <!-- produc CRUD section ends -->

    <!-- show product starts -->
    <section class="show-products">
        
        <div class="box-container">
            <?php
                $select_books= mysqli_query($conn, "SELECT * FROM `book`")
                or die('query failed');

                if(mysqli_num_rows($select_books)>0){
                    while($fetch_book= mysqli_fetch_assoc($select_books)){
                      
                        
                    ?>
                    <div class="box">
                        <img src="<?php echo $fetch_book['cover_image'];?>">
                        <div class="name"><?php echo $fetch_book['name'];?></div>
                        <div class="price"><?php echo number_format($fetch_book['price'], 0, ',', '.');?> đ</div>
                        <a href="admin_products.php?update=<?php echo $fetch_book['book_id']; ?>" 
                        class="option-btn">Edit</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_book['book_id']; ?>" 
                        class="delete-btn" onclick="return confirm('Bạn Muốn Xóa Quyển Sách Này?');">Xóa Sách</a>
                    
                    </div>
                    <?php
                    }

                }
                else{
                    echo '<p class="empty">Chưa Có Sách Nào Trong Cơ Sở Dữ Liệu!</p>';
                }
            ?>

            

        </div>


    </section>
    <!-- show product ends -->

    <!-- edit product starts -->
    <section class="edit-product-form">

        <?php
            if(isset($_GET['update'])){
                $update_id = $_GET['update'];
                $update_query = mysqli_query($conn,"SELECT * FROM `book`
                WHERE book_id = '$update_id'")
                or die('query failed');
                if(mysqli_num_rows($update_query)>0){
                    while($fetch_update = mysqli_fetch_assoc($update_query)){


        ?>

        <form action="" method="post">
            <input type="hidden" name="update_p__id" value="<?php echo $fetch_update['book_id'];?>">
            <img src="<?php echo $fetch_update['cover_image'];?>" alt="">
            
            <div class="text-box" style="display: grid;
                                    gap: 0 1.5rem;
                                    justify-content: center;
                                    grid-template-columns: repeat(auto-fit, 22rem);">
                <input type="text" name="update_name" value="<?php echo $fetch_update['name'];?>"
                class="box" required placeholder="Nhập Tên Sách">
                <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>"
                class="box" required placeholder="Nhập Giá Sách">

                <input type="text" name="update_author" value="<?php echo $fetch_update['author'];?>"
                class="box" required placeholder="Nhập Tên Tác Giả">
                <input type="text" name="update_publisher" value="<?php echo $fetch_update['publisher'];?>"
                class="box" required placeholder="Nhập Tên Nhà Xuất Bản">
                
                <select class="box" name="update_categogy" >

                <?php
                    // get current categogy name
                    $categogy_name = mysqli_query($conn, "SELECT * FROM `categogy` WHERE category_id='".$fetch_update['category_id']."'")
                    or die ('query failed');
                    $categogy_current = mysqli_fetch_assoc($categogy_name);
                ?>

                    <option value="<?php echo $categogy_current['category_id'];?>" ><?php echo $categogy_current['name'];?></option>
                <?php
                    //display categogy list
                    $categogys = mysqli_query($conn, "SELECT * FROM `categogy`")
                    or die ('query failed');
                    while($categogy = mysqli_fetch_assoc($categogys)){
                        echo '<option value="'.$categogy['category_id'].'">'.$categogy['name'].'</option>';
                    };
                ?>
                
            </select>

                <input type="text" name="update_cover_image" value="<?php echo $fetch_update['cover_image'];?>"
                class="box" required placeholder="Nhập Link Ảnh">
            </div>
                <textarea rows="3" name="update_description"
                class="box" required placeholder="Nhập Giới Thiệu"><?php echo $fetch_update['description'];?></textarea>
           

            <input type="submit" value="Cập Nhập" name="update_book" class="btn">
            <input type="reset" value="Hủy" id="close-update" class="option-btn">        </form>
        <?php
                    }
                }

            }
            else{
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
        
        ?>        

    </section>
    <!--  edit product ends -->


    <!-- custom js-->
    <script src="../js/admin_script.js"></script>



</body>
</html>