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
    <link href="https://cdn.jsdelivr.net/npm/@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">; 
    <!-- Css style -->
    <link rel="stylesheet" href="../css/ad_login_style.css" />

    <!--js-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Đăng nhập admin side</title>
  </head>
  <body>
    <div class="container">
      <div class="forms">
        <div class="form login">
          <span class="title">Đăng nhập Admin Page</span>
          <?php
            if(isset($_GET['Error'])){
              echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Error:</strong> '.$_GET['Error'].'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
              ';
            }
          ?>
          <form action="../php/validation.php"  method="post">
            <div class="input-field">
              <input
                type="email"
                name="username"
                placeholder="Nhập tên đăng nhập"
                required
              />
              <i class="uil uil-mailbox"></i>
            </div>
            <div class="input-field">
              <input
                type="password"
                name="password"
                class="password"
                placeholder="Nhập mật khẩu"
                required
              />
              <i class="uil uil-lock icon"></i>
              <i class="uil uil-eye-slash showHidePw"></i>
            </div>
            <div class="input-field button">
              <input type="submit" value="Đăng Nhập" name="submit"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>