<?php
    include('../config.php');
    function get_customer($customer_id){
        global $conn;
        $name="SELECT * FROM `customer` WHERE customer_id=$customer_id";
        $name_run = mysqli_query($conn,$name);
        return $name_run;
    }
?>