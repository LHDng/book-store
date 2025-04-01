<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Iconscout  -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">
    <!-- Css style -->
    <link rel="stylesheet" href="../../../public/css/LoginAndSignup/style.css" />

    <title>Reset password</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form forgot">
          <span class="title">Nhập mật khẩu mới</span>
          <form action="../../controller/resetPass_ctl.php" method="post">
          <input type="hidden" name="code" value="<?php  if(isset($_GET['code'])){echo $_GET['code'];}?>" />
          <br>
            <?php
                if(isset($_SESSION['status'])){
                    $p = $_SESSION['status'];
                    echo "
                    <div class='alert alert-primary' role='alert'> 
                    $p
                    </div>
                    ";  
                  unset($_SESSION['status']);
                }
            ?>
            <div class="input-field">
              <input
                type="password"
                name="pass"
                class="password"
                placeholder="Tạo mật khẩu mới"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                name="cpass"
                class="password"
                placeholder="Xác nhận lại mật khẩu"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>
            <div class="input-field button">
              <input type="submit" name="change_pass" value="Tiếp tục" />
            </div>
          </form>
          <div class="login-signup">
            <span class="text">
              <a href="forgotPassword.php" class="text login-link">Quay lại</a>
            </span>
          </div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
