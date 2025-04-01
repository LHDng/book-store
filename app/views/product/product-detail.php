<?php
include('../../controller/product_ctl.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="../../../public/css/product/product-detail.css">
    <link rel="stylesheet" href="../../../public/css/product/suggestion-item.css">
    <script src="https://kit.fontawesome.com/9d371022aa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <div class="main-container">
        <div class="product-body">
            <div class="product-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 book-cover">
                            <img src="<?php echo $book_info['cover_image']; ?>" alt="">
                        </div>
                        <div class="col book-title-quantity">
                            <div class="book-title"><?php echo $book_info['name']; ?></div>
                            <div class="rating">
                                <!-- <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> -->
                                <div><?php echo $number_of_rate . " đánh giá"; ?></div>
                            </div>

                            <div class="price-sold">
                                <div>
                                    <div><strong>Nhà xuất bản: </strong><?php echo $book_info['publisher']; ?></div>
                                    <div class="book-price"><?php echo number_format($book_info['price'], 0, ',', '.') . "đ"; ?></div>
                                </div>
                                <div>
                                    <div><strong>Tác giả: </strong><?php echo $book_info['author']; ?></div>
                                    <div class="sold-quantity">
                                        <button type="button" class="btn btn-warning">
                                            Đã bán <span class="badge text-bg-secondary"><?php echo $soluong_daban; ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div><strong>Chính sách đổi trả: </strong> Đổi trả sản phẩm trong 30 ngày <span class="badge rounded-pill text-bg-primary">Xem thêm</span></div>
                            <strong>Số lượng</strong>
                            <input type="number" class="form-control" id="set-quantity" name="set-quantity" value="1" min="1">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col">
                            <div class="buy-button">
                                <?php
                                if (isset($_SESSION['customer_id'])) {
                                ?>

                                    <button type="button" class="btn btn-outline-danger" id="addcart-bt" onclick="addCart(<?php echo $book_info['book_id'] ?>)"><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</button>
                                    <button type="button" class="btn btn-danger" id="buynow" onclick="buynow(<?php echo $book_info['book_id'] ?>)">Mua ngay</button>

                                <?php

                                } else {
                                ?>

                                    <a href="../LoginAndSignup/login.php"><button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</button></a>
                                    <a href="../LoginAndSignup/login.php"><button type="button" class="btn btn-danger">Mua ngay</button></a>

                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-body description">
            <div class="subtitle">Thông tin sản phẩm</div>
            <div><?php echo $book_info['description']; ?></div>
        </div>
        <div class="product-body suggestion">
            <div class="subtitle">Bookstore đề xuất</div>
            <div class="container">
                <div class="row text-center">
                    <?php
                    include '../components/suggestion-item.php';
                    ?>
                </div>
            </div>
        </div>
        <div class="product-body comment">
            <div class="subtitle">Đánh giá sản phẩm</div>
            <div class="rating">
                <div><?php echo $number_of_rate . " đánh giá"; ?></div>
            </div>
            <br>
            <div class="comment-button">
                <!-- <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <button type="button" class="btn btn-danger" id="commentBtn" data-bs-toggle="modal" data-bs-target="#commentBackdrop"><i class="fa-regular fa-pen-to-square"></i>Viết đánh giá</button>
                <div class="modal fade " id="commentBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="commentBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="commentBackdropLabel">ĐÁNH GIÁ SẢN PHẨM</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="newPhone" class="form-label">Viết đánh giá của bạn đi nào...</label>
                                <input type="text" class="form-control" id="newComment" name="newComment">
                                <input type="text" hidden="hidden" id="book-id" value="<?= $book_info['book_id'] ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary confirm-button" id="newComment-bt" name="newComment-sm">Gửi đánh giá</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <!-- <div class="comment-sort">
                <button type="button" class="btn btn-outline-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    Mới nhất
                </button>
            </div> -->

            <div class="container comments">
                <?php
                $item = 0;
                while ($cmt_info = mysqli_fetch_array($cmt_run)) {
                    $name = "SELECT `name` FROM `customer` WHERE customer_id=$cmt_info[customer_id]";
                    $name_run = mysqli_query($conn, $name);
                    $temp = mysqli_fetch_array($name_run);
                    if ($item > 7) {
                        break;
                    }
                    echo "
                    <div class='row a-comment'>
                        <div class='col-2 commentor-info'>
                            <strong>$temp[name]</strong>
                        </div>
                        <div class='col comment-content'>$cmt_info[comment]</div>
                    </div>";
                    $item = $item + 1;
                }
                ?>
            </div>

        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/function.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="../../js/cart.js"></script>
</body>

</html>