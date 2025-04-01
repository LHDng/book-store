<?php
    include ('../../controller/login_controller.php'); 
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

    <title>Đăng nhập</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form login">
          <span class="title">Đăng nhập</span>
          <form action="#"  method="post">
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
                type="text"
                name="email"
                placeholder="Nhập email của bạn"
                required
              />
              <i class="uil uil-mailbox"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                name="pass"
                class="password"
                placeholder="Nhập mật khẩu của bạn"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>
            <div class="checkbox-text">
              <a href="forgotPassword.php">Quên mật khẩu</a>
            </div>
            <div class="input-field button">
              <input type="submit" value="Đăng nhập" name="login"/>
            </div>
            <div class="input-field button">
               <input type="button" onclick="location.href='../customer/home.php';" value="Trang chủ" />
            </div>
          </form>
          <div class="login-signup">
            <span class="text"
              >Chưa nhận được mail xác thực? 
              <a href='resendEmailVerify.php' style="color:blue;">Gửi lại.</a>
            </span>
            <br>
            <span class="text"
              >Bạn chưa có tài khoản?
              <a href="signup.php">Đăng ký ngay</a>
            </span>
          </div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
