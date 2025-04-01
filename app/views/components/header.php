<div class="menu-wrapper">
    <!-- Header Section -->
    <div class="header bg-white shadow-sm">
        <div class="header-wrapper container-fluid">
            <div class="d-flex align-items-center justify-content-between py-2">
                <!-- Logo -->
                <div class="logo me-4">
                    <a href="../customer/home.php" class="d-block">
                        <img src="../../../public/images/logo/logo.png" alt="logo" class="img-fluid logo-img">
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="menu-search flex-grow-1 mx-4">
                    <form method="GET" action="../customer/home.php" class="search-form">
                        <input type="text" class="form-control search-input" id="search" name="search"
                            placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" class="search-button">
                            <img src="../../../public/images/header/search.png" alt="search" class="search-icon">
                        </button>
                    </form>
                </div>

                <!-- Icons -->
                <div class="icons d-flex align-items-center">
                    <?php if (!isset($_SESSION['customer_id'])): ?>
                        <div class="guest-button">
                            <a href='../LoginAndSignup/signup.php' class='btn btn-outline-primary btn-sm me-2'>Đăng ký</a>
                            <a href='../LoginAndSignup/login.php' class='btn btn-primary btn-sm'>Đăng nhập</a>
                        </div>
                    <?php else: ?>
                        <a href='../checkout/cart.php' class='cart-icon position-relative mx-3'>
                            <img src='../../../public/images/header/cart.png' alt='cart' class='header-icon'>
                            <span
                                class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0 <!-- Số lượng sản phẩm trong giỏ -->
                            </span>
                        </a>
                        <a href='../customer/account.php' class='profile-link ms-2'>
                            <img class='profile-icon rounded-circle' src='../../../public/images/header/user.png'
                                alt='profile'>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Section -->
    <div class="main-menu animate bg-primary">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <ul class="nav menu-nav py-2">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle menu-title" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Danh mục sách
                            </a>
                            <ul class="dropdown-menu menu-dropdown">
                                <li><a class="dropdown-item" href="../customer/home.php">Home</a></li>
                                <li><a class="dropdown-item" href="home.php?category_id=1">Tiểu thuyết</a></li>
                                <li><a class="dropdown-item" href="home.php?category_id=2">Sách kĩ năng</a></li>
                                <li><a class="dropdown-item" href="home.php?category_id=3">Thiếu nhi</a></li>
                                <li><a class="dropdown-item" href="home.php?category_id=4">Sách nước ngoài</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>