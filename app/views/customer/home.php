<?php
include('../../controller/product_ctl.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../../../public/css/header.css">
  <link rel="stylesheet" href="../../../public/css/footer.css">
  <link rel="stylesheet" href="../../../public/css/account/account.css">
  <link rel="stylesheet" href="../../../public/css/account/sidebar.css">
  <link rel="stylesheet" href="../../../public/css/home/home.css">
  <link rel="icon" type="image/x-icon" href="../../../public/images/logo/logo.png">
  <script src="https://kit.fontawesome.com/9d371022aa.js" crossorigin="anonymous"></script>
  <title>Home</title>
</head>

<body>
  <!-- <?php include '../components/banner.php'; ?> -->
  <?php
  include '../components/header.php';
  ?>
  <div class="home_container">
    <div class="grid">
      <div class="grid_row layout">
        <div class="grid_column-2">
          <nav class="home_category">
            <h4 class="category_heading">
              <i class="fa-solid fa-caret-right animate" style="margin-right: 10px; margin-left: 5px"></i>
              Danh mục
            </h4>

            <ul class="category-list animate">
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
          </nav>
        </div>
        <div class="grid_column-10">
          <div class="home-filter">
            <div class="home-filter__paginate">
              <ul class="pagination">
                <?php
                $temp = "";
                if (isset($_GET['category_id'])) $temp = "&category_id=" . $_GET['category_id'];
                if ($current_page > 1) {
                  $pre = $current_page - 1;
                  echo "<li class='page-item'><a class='page-link' href='?page=$pre" . $temp . "'>Previous</a></li>";
                } else {
                  echo
                  "<li class='page-item disabled'>
                      <a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Previous</a>
                    </li>";
                }
                if ($current_page == $total_page && $total_page >= 3) {
                  $last_page_mn3 = ($current_page - 2);
                  echo "<li class='page-item'><a class='page-link' href='?page=$last_page_mn3" . $temp . "'>$last_page_mn3</a></li>";
                }
                for ($i = 1; $i <= $total_page; $i++) {
                  if ($i != $current_page) {
                    if ($i > $current_page - 2 && $i < $current_page + 2) {
                      echo "<li class='page-item'><a class='page-link' href='?page=$i" . $temp . "'>$i</a></li>";
                    }
                  } else {
                    echo "
                      <li class='page-item active' aria-current='page'>
                        <span class='page-link'>$i</span>
                      </li>
                      ";
                  }
                }
                if ($current_page == 1 && $total_page >= 3) {
                  echo "<li class='page-item'><a class='page-link' href='?page=3" . $temp . "'>3</a></li>";
                }
                if ($current_page < $total_page) {
                  $next = $current_page + 1;
                  echo "<li class='page-item'><a class='page-link' href='?page=$next" . $temp . "'>Next</a></li>";
                } else {
                  echo
                  "<li class='page-item disabled'>
                     <a class='page-link' href='#' tabindex='-1' aria-disabled='true'>Next</a>
                    </li>";
                }
                ?>
              </ul>
            </div>
          </div>

          <div class="home-product">
            <?php
            include('../product/product-list.php');
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  include '../components/footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../../js/jquery.js"></script>
  <script src="../../js/function.js"></script>
  <script>
    $(document).ready(function() {
      $("nav h4 i").on("click", () => {
        if ($("nav ul").css('opacity') == '0') {
          $("nav ul").css({
            "opacity": "1",
            "display": "block"
          });
          $(".category_heading").css({
            'border-bottom-left-radius': '0',
            'border-bottom-right-radius': '0',
            'margin-bottom': '0'
          })
          $("nav h4 i").css('transform', 'rotate(90deg)');
        } else {
          $("nav ul").css({
            "opacity": "0",
            "display": "none"
          });
          $(".category_heading").css({
            'border-radius': '5px',
            'margin-bottom': '10px'
          })
          $("nav h4 i").css('transform', 'rotate(0deg)');
        }

      });
    });
  </script>
</body>

</html>