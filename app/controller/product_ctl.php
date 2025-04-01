<?php
        include('../../config.php');
        include('../../model/ctmAccount_model.php');
        
        $item_per_page = 10;
        $total_page;
        $current_page = (!empty($_GET['page'])) ? $_GET['page']  :1;
        $offset = ($current_page - 1) * $item_per_page;
        if(isset($_GET['category_id'])){
            $db_book="SELECT * FROM `book` WHERE `category_id`=$_GET[category_id] ORDER BY `book_id` DESC"
                    . " LIMIT " . $item_per_page . " OFFSET " . $offset;
            $db_book_run = mysqli_query($conn,$db_book);


            $total_records = mysqli_query($conn,"SELECT * FROM `book` WHERE `category_id`=$_GET[category_id]");
            $total_records = mysqli_num_rows($total_records);
            $total_page = ceil($total_records /  $item_per_page);


            if(!$db_book_run){
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            } 
        }else if(isset($_GET['search']) && !empty($_GET['search'])){
            $db_book="SELECT * FROM `book` WHERE `name` LIKE '%$_GET[search]%' OR `author` LIKE '%$_GET[search]%' ORDER BY `book_id` DESC"
                    . " LIMIT " . $item_per_page . " OFFSET " . $offset;
            $db_book_run = mysqli_query($conn,$db_book);
            

            $total_records = mysqli_query($conn,"SELECT * FROM `book` WHERE `name` LIKE '%$_GET[search]%' OR `author` LIKE '%$_GET[search]%'");
            $total_records = mysqli_num_rows($total_records);
            $total_page = ceil($total_records /  $item_per_page);

            if(!$db_book_run){
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            } 
        }else{
            $db_book="SELECT * FROM `book` ORDER BY `book_id` DESC"
                        . " LIMIT " . $item_per_page . " OFFSET " . $offset;
            $db_book_run = mysqli_query($conn,$db_book);


            $total_records = mysqli_query($conn,"SELECT * FROM `book`");
            $total_records = mysqli_num_rows($total_records);
            $total_page = ceil($total_records /  $item_per_page);

            if(!$db_book_run){
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            }   
        }

        if(isset($_GET['book_id'])){
            $book_id = $_GET['book_id'];
            $book="SELECT * FROM `book` WHERE book_id=$book_id LIMIT 1";
            $book_run = mysqli_query($conn,$book);
            if($db_book_run){
                $book_info = mysqli_fetch_array($book_run);
            }else{
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            }
            // GET COMMENT
            $cmt="SELECT * FROM `rate` WHERE book_id=$book_id";
            $cmt_run = mysqli_query($conn,$cmt);
            $number_of_rate = mysqli_num_rows($cmt_run);
            if(!$cmt_run){
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            }

            $daban = "SELECT * FROM `contain` WHERE book_id=$book_id";
            $daban_run = mysqli_query($conn,$daban);
            $soluong_daban = mysqli_num_rows($daban_run);
            if(!$daban_run){
                header('location: ../LoginAndSignup/home.php');
                exit(0);
            }
        }
?>