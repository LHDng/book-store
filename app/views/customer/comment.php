<?php
include('../../controller/comment_ctl.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
    <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/header.css">
    <link rel="stylesheet" href="../../../public/css/footer.css">
    <link rel="stylesheet" href="../../../public/css/account/sidebar.css">
    <link rel="stylesheet" href="../../../public/css/account/comment.css">
    <script src="https://kit.fontawesome.com/9d371022aa.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include '../components/header.php'; ?>
    <div class="main-container">
        <div class="container-fluid content">
            <div class="row">
                <div class="col-3">
                    <?php include '../components/customer-sidebar.php'; ?>
                </div>
                <div class="col-9">
                    <div class="comment">
                        <p class="comment-title">NHẬN XÉT CỦA TÔI</p>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($comment_run)) {
                            $book = "SELECT * FROM `book` WHERE book_id=$row[book_id] LIMIT 1";
                            $book_run = mysqli_query($conn, $book);
                            $book_info = mysqli_fetch_array($book_run);
                            $price = number_format($book_info['price'], 0, ',', '.') . "đ";
                            echo "<div class='a-book'>
                                <div class='box-wrapper'>
                                    <img src='$book_info[cover_image]' alt=''>
                                    <div><strong>$book_info[name]</strong></div>
                                    <div><strong>Tác giả: </strong>$book_info[author]</div>
                                    <div><strong>Giá: </strong><span class='price'>$price</span></div>
                                    <i class='fa-solid fa-chevron-down comment-toggle icon-button' id='book$i'></i>
                                </div>
                                <div class='box-wrapper book-comment' id='comment$i'>
                                    <table class='table table-striped'>
                                        <thead>
                                            <tr>
                                                <th>Bình luận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>$row[comment]</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>";
                            $i++;
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/function.js"></script>
</body>

</html>