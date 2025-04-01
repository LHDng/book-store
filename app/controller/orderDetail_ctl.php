<?php
        include('../../config.php');
        include('../../model/ctmAccount_model.php');

        if(isset($_GET['oder_id'])){
            $oder_id = $_GET['oder_id'];
            $db_oder="SELECT * FROM oder WHERE oder_id='$oder_id' LIMIT 1";
            $db_oder_run = mysqli_query($conn,$db_oder);
            // LAY THONG TIN CUA KHACH HANG
            // TRANG THAI DON HANG, NGAY DAT HANG, GIA TIEN,PHUONG THUC THANH TOAN
            // LAY ADDRESS_ID
            if($db_oder_run){
                if($row = mysqli_fetch_array($db_oder_run)){
                    if($row['status'] == 1){
                        $status = "Đang xử lý";
                    }else if($row['status'] == 2){
                        $status = "Hoàn thành";
                    }
                    $oder_date = $row['oder_date'];
                    $cost = number_format($row['cost'], 0, ',', '.') . "đ";
                    $payment_method = $row['payment_method'];
                    $customer_id = $row['customer_id'];
                    $address_id = $row['address_id'];
                }else{
                    header('location: order-history.php');
                    exit(0);
                }
            }else{
                header('location: order-history.php');
                exit(0);
            }
            
            //LAY THONG TIN NGUOI NHAN

            // LAY DIA CHI

            $db_add="SELECT `address` FROM `address` WHERE address_id='$address_id' AND customer_id='$customer_id' LIMIT 1";
            $db_add_run = mysqli_query($conn,$db_add);
            if($db_add_run){
                if($row = mysqli_fetch_array($db_add_run)){
                    $address = $row['address'];
                }else{
                    header('location: order-history.php');
                    exit(0);
                }
            }else{
                header('location: order-history.php');
                exit(0);
            }

            // LAY TEN, SDT
            $db_info="SELECT `name`, `phone` FROM `customer` WHERE customer_id='$customer_id' LIMIT 1";
            $db_info_run = mysqli_query($conn,$db_info);
            if($db_info_run){
                if($row = mysqli_fetch_array($db_info_run)){
                    $name = $row['name'];
                    $phone = $row['phone'];
                }else{
                    header('location: order-history.php');
                    exit(0);
                }
            }else{
                header('location: order-history.php');
                exit(0);
            }

            // LAY THONG TIN SAN PHAM


            $db_quantity="SELECT * FROM `contain` WHERE oder_id='$oder_id'";
            $db_quantity_run = mysqli_query($conn,$db_quantity);
            $book_info = array(); //luu thong tin cua sach
            $book_soluong = array(); // luu so luong cua quan sach do (quan sach ben ben tren)
            if($db_quantity_run){
                $number_book = mysqli_num_rows($db_quantity_run); // so luon cua $book_soluong
                while($row = mysqli_fetch_array($db_quantity_run)){
                    array_push($book_soluong,$row['quantity']);
                    $db_book="SELECT * FROM `book` WHERE book_id='$row[book_id]'";
                    $db_book_run = mysqli_query($conn,$db_book);
                    if($temp = mysqli_fetch_array($db_book_run)){
                        array_push($book_info,$temp);
                    }else{
                        header('location: order-history.php');
                        exit(0);
                    }
                }
            }else{
                header('location: order-history.php');
                exit(0);
            }

        }else{
            header('location: order-history.php');
            exit(0);
        }
?>