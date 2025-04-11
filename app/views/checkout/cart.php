<?php
include('../../controller/cart_ctl.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="../../../public/css/checkout/cart.css">
    <script src="https://kit.fontawesome.com/9d371022aa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <div class="main-container">
        <div class="cart">
            <form action="../../controller/checkout_ctl.php" method="post">
                <div class="container">
                    <div class="row cart-info">
                        <div class="col-xl-8 column-content">
                            <div class="order">
                                <div class="subtitle">Giỏ hàng: <?= $number_item ?> sản phẩm</div>
                                <div class="section-wrapper">
                                    <?php
                                    while ($row = mysqli_fetch_array($db_cart_run)) {
                                        include '../components/checkout-item.php';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="payment">
                                <div class="subtitle">Phương thức thanh toán</div>
                                <div class="section-wrapper">
                                    <fieldset id="payment-methods">
                                        <div class="form-check">
                                            <input class="form-check-input payment-method" type="radio"
                                                name="method-payment" id="method-cod" value="cash" checked>
                                            <label class="form-check-label" for="method-cod">
                                                <i class="fas fa-money-bill-wave"></i> Thanh toán khi nhận hàng (COD)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input payment-method" type="radio"
                                                name="method-payment" id="method-bank" value="vnpay">
                                            <label class="form-check-label" for="method-bank">
                                                <i class="fas fa-university"></i> Thẻ ngân hàng (VNPay)
                                            </label>
                                            <div class="bank-logos" style="display:none; margin-top:10px;">
                                                <img src="../../public/images/vnpay-bank.png" height="30"
                                                    style="margin-right:10px;">
                                                <img src="../../public/images/vietcombank.png" height="30">
                                                <!-- Thêm các ngân hàng khác -->
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input payment-method" type="radio"
                                                name="method-payment" id="method-momo" value="momo">
                                            <label class="form-check-label" for="method-momo">
                                                <i class="fas fa-wallet"></i> Ví điện tử Momo
                                            </label>
                                            <div class="momo-qr" style="display:none; margin-top:10px;">
                                                <img src="../../public/images/momo-qr.png" height="120">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="address">
                                <div class="subtitle">Địa chỉ nhận hàng</div>
                                <div class="section-wrapper">
                                    <fieldset id="group2">
                                        <?php
                                        while ($row = mysqli_fetch_array($db_address_run)) {
                                            echo "
                                        <div class='form-check'>
                                            <input class='form-check-input' type='radio' name='address' value='$row[address_id]' checked>
                                            <label class='form-check-label' for='address'>
                                                $row[address]
                                            </label>
                                        </div>
                                        ";
                                        }
                                        ?>
                                    </fieldset>
                                </div>
                            </div>
                            <input hidden="hidden" type="text" id="total-price" name="all-total-price"
                                value=<?= $total_price; ?>>
                        </div>
                        <div class="col-xl-4 column-content">
                            <div class="summary">
                                <div class="subtitle">Đơn hàng</div>
                                <div class="section-wrapper">
                                    <div style="display: flex; flex-direction:column;row-gap:10px;">
                                        <div style="display: flex; justify-content:space-between;">
                                            <input hidden="hidden" type="number" id="it-price" value=<?= $total_price; ?>>
                                            <strong>Thành tiền: </strong><span
                                                id="dp-it-price"><?= number_format($total_price, 0, ',', '.') . "đ"; ?></span>
                                        </div>
                                        <div style="display: flex; justify-content:space-between;">
                                            <strong>Phí dịch vụ: </strong><span id="dp-sv-price"></span>
                                        </div>
                                        <div style="display: flex; justify-content:space-between;">
                                            <strong>Tổng số tiền: </strong><span
                                                id="dp-total-price"><?= number_format($total_price, 0, ',', '.') . "đ"; ?></span>
                                        </div>
                                    </div>
                                    <div class="mui-divider"></div>
                                    <div class="gogo">
                                        <?php
                                        if ($number_item > 0) {
                                            echo "<button class='btn btn-danger' type='submit' name='buy'>Thanh toán</button>";
                                        } else {
                                            echo "<button class='btn btn-danger' type='button'>Thanh toán</button>";
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="additional">
                                <div class="subtitle">Dịch vụ đi kèm</div>
                                <div class="section-wrapper">
                                    <div class="service-item">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input service" type="checkbox" role="switch"
                                                id="wrap-service" data-price="20000">
                                            <label class="form-check-label" for="wrap-service">Bọc sách bằng giấy
                                                kiếng</label>
                                        </div>
                                        <div class="service-price">+20.000đ</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="payment-alert" class="alert alert-info mt-3" style="display:none;">
                        Khi chọn thanh toán online, bạn sẽ được chuyển đến cổng thanh toán tương ứng
                    </div>
                    <div class="row checkout-button">
                        <button type="button" class='btn btn-warning home'>Tiếp tục mua hàng</button>
                        <?php
                        if ($number_item > 0) {
                            echo "<button class='btn btn-danger' type='submit' name='buy'>Xác nhận thanh toán</button>";
                        } else {
                            echo "<button class='btn btn-danger' type='button'>Xác nhận thanh toán</button>";
                        }
                        ?>
                    </div>
                </div>
        </div>

    </div>
    </form>
    </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/function.js"></script>
</body>

</html>