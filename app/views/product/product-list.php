<?php
$item = mysqli_num_rows($db_book_run) - 1;
$cur_temp = 0;
$old_temp = $cur_temp;
    while($row = mysqli_fetch_array($db_book_run)){
        $price = number_format($row['price'], 0, ',', '.') . "đ";
        if(($cur_temp % 5) == 0){
            $old_temp = $cur_temp;
            echo "<div class='grid_row'>";
        }
        echo "
        <!-- Product item -->
        <div class='grid_column-2-4'>
        <a href='../product/product-detail.php?book_id=$row[book_id]' style='text-decoration: none'>
          <div class='home-product-item'>
            <div
              class='home-product-item__img'
              style='
                background-image: url($row[cover_image]);
              '
            ></div>
            <h4 class='home-product-item__name'>
              $row[name]
            </h4>
            <div class='home-product-item__price'>
              <span class='home-product-item__price-new'> $price</span>
            </div>
          </div>
          </a>
        </div>
        ";
        if(($cur_temp - $old_temp) == 4 || ($cur_temp == $item)){
            echo "</div>";
        }
        $cur_temp =$cur_temp +1;
    }
?>