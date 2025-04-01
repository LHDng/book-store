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
    <link rel="stylesheet" href="../../../public/css/account/account.css">
    <link rel="stylesheet" href="../../../public/css/account/sidebar.css">

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
                    <div class="profile">
                        <form method="post" action="">
                            <div class="logout-button">
                                <p class="profile-title">THÔNG TIN TÀI KHOẢN</p>
                                <a href="../../controller/logout_controller.php">
                                    <button type="button" class="btn btn-outline-danger">Đăng xuất</button></a>
                            </div>
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
                                <div class="col-4">
                                    <ul>
                                        <li><label for="name" class="form-label">Họ và Tên*</label></li>
                                        <li><label for="phone" class="form-label">Số điện thoại*</label></li>
                                        <li><label for="email" class="form-label">Email*</label></li>
                                        <li><label for="email" class="form-label">Password*</label></li>
                                    </ul>
                                </div>
                                <div class="col-8">
                                    <ul>
                                        <li>
                                            <button class="edit-button"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
                                        </li>
                                        <li>
                                            <button type="button" class="edit-button" id="phoneBtn" data-bs-toggle="modal" data-bs-target="#phoneBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone_number; ?>" readonly>
                                            <div class="modal fade " id="phoneBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="phoneBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="phoneBackdropLabel">THAY ĐỔI SỐ ĐIỆN THOẠI</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="newPhone" class="form-label">Nhập số điện thoại mới</label>
                                                            <input type="text" class="form-control" id="newPhone" name="newPhone">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary confirm-button" name="newPhone-sm">Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <button type="button" class="edit-button" id="emailBtn" data-bs-toggle="modal" data-bs-target="#emailBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
                                            <div class="modal fade " id="emailBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emailBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="emailBackdropLabel">THAY ĐỔI EMAIL</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="newEmail" class="form-label">Nhập email mới</label>
                                                            <input type="email" class="form-control" id="newEmail" name="newEmail">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary confirm-button" name="newEmail-sm">Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <button type="button" class="edit-button" id="emailBtn" data-bs-toggle="modal" data-bs-target="#passwordBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <input type="text" class="form-control" id="email" value="<?php echo $password; ?>" readonly>
                                            <div class="modal fade " id="passwordBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emailBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="emailBackdropLabel">THAY ĐỔI PASSWORD</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="oldPass" class="form-label">Nhập password hiện tại</label>
                                                            <input type="text" class="form-control" id="oldPass" name="oldPass">
                                                            <label for="newPass" class="form-label">Nhập password mới</label>
                                                            <input type="text" class="form-control" id="newPass" name="newPass">
                                                            <label for="confirm" class="form-label">Nhập lại password mới để xác nhận</label>
                                                            <input type="text" class="form-control" id="confirm" name="confirm">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary confirm-button" name="change-pass-sm">Xác nhận</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="submit-button">
                                <button type="submit" class="btn btn-danger" name="change-value-account">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/function.js"></script>
</body>

</html>