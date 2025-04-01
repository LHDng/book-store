function addCart(book_id){
    quantity = $("#set-quantity").val();
    $.ajax({
        type: "POST",
        url: '../../controller/addCart_ctl.php',
        data: {quantity:quantity,book_id:book_id},
        cache: false,
        success: function(data){
            alert("Thêm vào giỏ hàng thành công");
        }
    });
}
function buynow(book_id){
    quantity = $("#set-quantity").val();
    $.ajax({
        type: "POST",
        url: '../../controller/addCart_ctl.php',
        cache: false,
        data: {quantity:quantity,book_id:book_id},
        success: function(){
            location.replace('../../views/checkout/cart.php');
        }
    });
}