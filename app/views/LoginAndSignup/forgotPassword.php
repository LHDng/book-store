<?php
    include('../../controller/forgotPass_ctl.php');
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

    <title>Quên mật khẩu</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form forgot">
          <span class="title">Quên mật khẩu</span>
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
            <div class="input-field">
              <input
                type="text"
                name="email"
                placeholder="Nhập email của bạn"
                required
              />
              <i class="uil uil-mailbox"></i>
            </div>
            <div class="input-field button">
              <input type="submit" value="Tiếp tục" name="pass_reset_link"/>
            </div>
          </form>
          <div class="login-signup">
            <span class="text">
              <a href="login.php" class="text login-link">Quay lại</a>
            </span>
          </div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
