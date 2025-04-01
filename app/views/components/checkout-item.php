<?php
$book_id = $row['book_id'];
$quantity = $row['quantity'];
$db_book = "SELECT * FROM book WHERE book_id='$book_id' LIMIT 1";
$db_book_run = mysqli_query($conn, $db_book);
$book_info = mysqli_fetch_array($db_book_run);
if ($book_info['category_id'] == 1) {
    $category = "Tiểu thuyết";
} else if ($book_info['category_id'] == 2) {
    $category = "Sách kĩ năng";
} else if ($book_info['category_id'] == 3) {
    $category = "Thiếu nhi";
} else {
    $category = "Sách nước ngoài";
}
$item_total_price_ip = $quantity * $book_info['price'];
$item_total_price = number_format($item_total_price_ip, 0, ',', '.') . "đ";
?>

<?php
$total_price = $total_price + $item_total_price_ip;
echo "
        <div class='checkout-item'>
            <div class='image-info'>
                <img src='$book_info[cover_image]' alt=''>
                <div class='item-info'>
                    <div><strong>$book_info[name]</strong></div>
                    <div><strong>Tác giả: </strong>$book_info[author]</div>
                    <div><strong>Thể loại: </strong>$category</div>
                </div>
            </div>
            <div class='price-quantity'>
                <span>Số lượng:</span>
                <input type='hidden' class='book_id' value='$book_id'>
                <input type='hidden' class='tt_price' value='$item_total_price'>
                <input type='number' class='form-control itemQty' value='$row[quantity]' min='1'>
                <div class='price'> $item_total_price</div>
                <a href='../../controller/checkout_ctl.php?delete_book=$book_id'>
                <i class='fa-solid fa-trash-can'></i>
                </a>
            </div>
        </div>
        <div class='item-info-small'>
            <div><strong>$book_info[name]</strong></div>
            <div><strong>Tác giả: </strong>$book_info[author]</div>
            <div><strong>Thể loại: </strong>$category</div>
        </div>  
        <div class='mui-divider'></div>
    ";
?>

<!-- <a href='../../controller/checkout_ctl.php?delete_book=$book_info[book_id]'>Xóa</a> -->