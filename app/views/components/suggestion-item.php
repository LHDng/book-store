<?php
$db_book_suggest = "SELECT * FROM `book` LIMIT 6";
$db_book_suggest_run = mysqli_query($conn, $db_book_suggest);
if (!$db_book_suggest_run) {
    header('location: ../customer/home.php');
    exit(0);
}

while ($suggest = mysqli_fetch_array($db_book_suggest_run)) {
    $price = number_format($suggest['price'], 0, ',', '.') . "đ";
    echo "
    <div class='col suggested-item'>
        <div class='flex-item'>
            <a href='../product/product-detail.php?book_id=$suggest[book_id]' style='text-decoration: none'>
                <img  src='$suggest[cover_image]' alt='' class='suggested-cover' width='150px' height='150px'>
            </a>
            <p class='suggested-item_name'>
                $suggest[name]
            </p>
        </div>
        
        <div class='flex-item'>
            <strong class='sub-price'>$price</strong>
        </div>
    </div>
        ";
}
