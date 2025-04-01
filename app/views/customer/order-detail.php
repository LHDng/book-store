<?php
include('../../controller/orderDetail_ctl.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="../../../public/css/account/sidebar.css">
    <link rel="stylesheet" href="../../../public/css/account/order-detail.css">
    <script src="https://kit.fontawesome.com/9d371022aa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <div class="main-container">
        <div class="container-fluid content">
            <div class="row">
                <div class="col-3">
                    <?php include '../components/customer-sidebar.php'; ?>
                </div>
                <div class="col-9">
                    <!-- <div class="order-view-detail"> -->
                    <div class="order-view-info">
                        <p class="detail-title">CHI TIẾT ĐƠN HÀNG</p>
                        <div class="order-view-status"> <?php echo $status; ?></div>
                        <p> <strong>Mã đơn hàng: </strong><?php echo $oder_id; ?></p>
                        <p> <strong>Ngày mua: </strong><?php echo $oder_date; ?></p>
                        <p><strong>Tổng tiền: </strong><?php echo $cost; ?></p>
                    </div>
                    <div class="container order-view-method">
                        <div class="row">
                            <div class="col">
                                <div class="col-content">
                                    <p class="detail-title">THÔNG TIN NGƯỜI NHẬN</p>
                                    <p><?php echo $name; ?></p>
                                    <p><?php echo $address; ?></p>
                                    <p><?php echo "TEL: " . $phone; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="col-content">
                                    <p class="detail-title">PHƯƠNG THỨC THANH TOÁN</p>
                                    <p><?php echo $payment_method; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="order-view-product">
                    <p class="detail-title">THÔNG TIN SẢN PHẨM</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá bán</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < $number_book; $i++) {
                                $src = $book_info[$i]['cover_image'];
                                $name = $book_info[$i]['name'];
                                $price = number_format($book_info[$i]['price'], 0, ',', '.') . "đ";
                                $cost = number_format($book_info[$i]['price'] * $book_soluong[$i], 0, ',', '.') . "đ";
                                echo "
                                            <tr>
                                            <td><img class='product-image' src='$src' alt=''></td>
                                            <td>$name</td>
                                            <td>$price</td>
                                            <td>$book_soluong[$i]</td>
                                            <td>$cost</td>
                                            </tr>
                                            ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/function.js"></script>
</body>

</html>