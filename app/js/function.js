function format1(n) {
  var currency = "đ";
  return (
    n.toFixed(0).replace(/./g, function (c, i, a) {
      return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    }) + currency
  );
}

$(document).ready(function () {
  $(".menu-toggle").click(function () {
    // console.log($(".menu").css("display"));
    if ($(".menu").css("opacity") == "0") {
      $(".menu").css("opacity", "1");
    } else $(".menu").css("opacity", "0");
  });

  $(".menu-wrapper").click(function () {
    console.log("tstestsets");
  });

  $("#phoneBtn").on("click", function () {
    $("#phoneBackdrop").modal("show");
  });

  $("#emailBtn").on("click", function () {
    $("#emailBackdrop").modal("show");
  });

  $(".comment-toggle").click((event) => {
    let i = event.currentTarget.id.charAt(4);
    console.log(event.currentTarget);
    console.log(event.currentTarget.id.charAt(4));
    if ($(`#comment${i}`).css("display") == "none") {
      $(`#comment${i}`).css("display", "block");
    } else {
      $(`#comment${i}`).css("display", "none");
    }
  });

  $(".itemQty").on("change", function () {
    var $el = $(this).closest("div");
    var book_id = $el.find(".book_id").val();
    var quantity = $el.find(".itemQty").val();
    $.ajax({
      url: "../../controller/addCart_ctl.php",
      method: "POST",
      cache: false,
      data: { change_quantity: quantity, book_id: book_id },
      success: function () {
        location.reload(true);
      },
    });
  });
  $(".service").on("click", function () {
    var service = 0;
    $(".service:checked").each(function () {
      service = 20000;
    });
    var tt_price = service + Number($("#it-price").val());
    $("#dp-sv-price").html(format1(service));
    $("#dp-total-price").html(format1(tt_price));
    $("#total-price").val(tt_price);
  });
  $(".home").on("click", function () {
    location.replace("../../views/customer/home.php");
  });
  $("#newComment-bt").on("click", function () {
    var comment = $("#newComment").val();
    var book_id = $("#book-id").val();
    $.ajax({
      url: "../../controller/addcmt_ctl.php",
      method: "POST",
      cache: false,
      data: { comment: comment, book_id: book_id },
      success: function () {
        location.reload(true);
      },
    });
  });
});
