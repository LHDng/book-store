<?php
include('../../controller/ctmAccount_ctl.php');
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
    <link rel="stylesheet" href="../../../public/css/account/address.css">
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
                    <div class="address">
                        <p class="address-title">SỔ ĐỊA CHỈ</p>
                        <div class="row">
                            <?php
                            if (!empty($mess)) {
                                echo "
                                <div class='alert alert-danger' role='alert'> 
                                $mess
                                </div>
                                ";
                            }
                            if (isset($_SESSION['status'])) {
                                $p = $_SESSION['status'];
                                echo "
                                <div class='alert alert-primary' role='alert'> 
                                $p
                                </div>
                                ";
                                unset($_SESSION['status']);
                            }
                            ?>
                            <!-- <div class="col">
                                <p class="address-subtitle">
                                    Địa chỉ nhận hàng mặc định:
                                </p>
                                <p class="main-address">
                                    <?php
                                    if (isset($default_add)) {
                                        echo $default_add;
                                    }
                                    ?>
                                </p>

                            </div> -->
                            <div class="col">
                                <div class="address-table">
                                    <div>
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Địa chỉ nhận hàng</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include('listAddress.php');
                                                ?>
                                            </tbody>
                                        </table>
                                        <form method="post" action="">
                                            <button type="button" class="btn btn-danger" id="emailBtn" data-bs-toggle="modal" data-bs-target="#newReceiveAddress">Thêm địa chỉ</button>
                                            <div class="modal fade " id="newReceiveAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emailBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="emailBackdropLabel">THÊM ĐỊA CHỈ NHẬN HÀNG</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="new-address" class="form-label">Nhập địa chỉ mới</label>
                                                            <input type="text" class="form-control" id="new-address" name="new-address" value="<?php echo $new_address ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary confirm-button" name="new-address-sm">Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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