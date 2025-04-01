<?php
    include ('../../controller/signup_controller.php');
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

    <title>Đăng ký</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form signup">
          <span class="title">Đăng ký</span>
          <form action="#" method="post">
            <br>
            <?php
                if(!empty($mess)){
                    echo "
                    <div class='alert alert-danger' role='alert'> 
                    $mess
                    </div>
                    ";
                }
            ?>
            <?php
                if(!empty($succMess)){
                    echo "
                    <div class='alert alert-primary' role='alert'> 
                    $succMess
                    </div>
                    ";
                }
            ?>
            <div class="input-field">
              <input type="text" name="name" value="<?php echo $name?>" placeholder="Nhập tên của bạn" required />
              <i class="uil uil-user"></i>
            </div>
            <div class="input-field">
              <input
                type="text"
                name="mail"
                value="<?php echo $email?>"
                placeholder="Nhập địa chỉ email"
                required
              />
              <i class="uil uil-mailbox"></i>
              <!-- <a href="login.html"><i class="uil uil-message send"></i></a> -->
            </div>
            <!-- <div class="input-field">
              <input
                type="text"
                name="verify"
                placeholder="Nhập mã xác nhận 6 chữ số"
                required
              />
              <i class="uil uil-shield"></i>
            </div> -->
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

              <!-- Dat sua -->
              <input type="submit" value="Đăng ký" name="signup"/> 
            </div>
            <div class="input-field button">
              <input type="button" onclick="location.href='../customer/home.php';" value="Trang chủ" />
            </div>
          </form>
          <div class="login-signup">
            <span class="text"
              >Bạn đã có tài khoản?
              <a href="login.php">Đăng nhập ngay</a>
            </span>
          </div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
