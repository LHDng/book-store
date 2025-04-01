<?php
include 'connect.php';
session_start();

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);

    $select_admin = mysqli_query($conn, "SELECT * FROM `admin`
                                         WHERE email = '$username' AND
                                               password ='$pass'")
                                or die ('query failed');
    if(mysqli_num_rows($select_admin)>0){
        
        $row = mysqli_fetch_assoc($select_admin);
        $_SESSION['admin_id']= $row['admin_id'];
        $_SESSION['user_name']= $row['email'];
        $_SESSION['name']= $row['name'];

        header("Location: ../view/admin_page.php");

    }
    else{
        $message='Incorrect email or password!';
        header("Location: ../view/login.php?Error=$message");
    }
}
?>