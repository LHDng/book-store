<?php 
include "../php/connect.php";
$res=mysqli_fetch_assoc(mysqli_query($conn,"SELECT CURDATE() AS date;"));
echo $res['date'];