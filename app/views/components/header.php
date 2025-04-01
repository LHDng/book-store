<div class="menu-wrapper">
    <div class="header">
        <div class="header-wrapper">
            <div class="logo">
                <a href="../customer/home.php"><img src="../../../public/images/logo/logo.png" alt="logo"></a>
            </div>
            <div class="menu-search">
                <!-- <button type="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
                

                <!-- </button> -->
                <form style="position: relative;" method="GET" action="../customer/home.php">
                    <!-- <button type="submit" class="search-button">
                        <img src="../../../public/images/header/search.png" alt="" width="20px" height="20px"> 
                    </button> -->
                    <input type="text" class="form-control" id="search" name="search" placeholder="Tìm kiếm sản phẩm">
                </form>
            </div>
            <div class="icons">
                <?php
                if (!isset($_SESSION['customer_id'])) {
                    echo "
                        <div class='guest-button'>
                            <a href='../LoginAndSignup/signup.php'><button type='button' class='btn btn-primary  btn-sm'>Đăng ký</button></a>
                            <a href='../LoginAndSignup/login.php'><button type='button' class='btn btn-danger  btn-sm'>Đăng nhập</button></a>
                        </div>
                        ";
                } else {
                    echo "
                        <a href='../checkout/cart.php' class='position-relative icon-button'><img src='../../../public/images/header/cart.png' alt='cart' class='header-icon'>
                        </a>
                        ";
                    echo "
                        <a href='../customer/account.php' class='profile-link icon-button'><img class='header-icon' src='../../../public/images/header/user.png' alt='profile'></a>
                        ";
                }
                ?>

            </div>
        </div>
    </div>

    <div class="menu animate">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5>Danh mục sách</h5>
                    <ul>
                        <li class="category-item">
                            <a href="home.php?category_id=1" class="category-item__link">Tiểu thuyết</a>
                        </li>
                        <li class="category-item">
                            <a href="home.php?category_id=2" class="category-item__link">Sách kĩ năng</a>
                        </li>
                        <li class="category-item">
                            <a href="home.php?category_id=3" class="category-item__link">Thiếu nhi</a>
                        </li>
                        <li class="category-item">
                            <a href="home.php?category_id=4" class="category-item__link">Sách nước ngoài</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>