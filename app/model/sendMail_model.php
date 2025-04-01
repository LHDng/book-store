<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';
    
    function sendmail_Verify($email, $code){
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bookstorebk412@gmail.com';                     //SMTP username
        $mail->Password   = 'tflpnhxaxckznksk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('bookstorebk412@gmail.com');
        $mail->addAddress($email);     //Add a recipient
        
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'noreply';
    
        $text = "
            <h2>Bạn đã đăng kí tài khoản ở Bookstore</h2>
            <h5>Xác thực tài khoản bằng cánh ấn link dưới</h5>
            <br><br>
            <a href='http://localhost/website/app/controller/verify.php?code=$code'>Click me</a>
        ";
    
        $mail->Body    = $text;
       
        $mail->send();
    }

    function sendmail_pass_reset($email, $code){
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bookstorebk412@gmail.com';                     //SMTP username
        $mail->Password   = 'tflpnhxaxckznksk';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('bookstorebk412@gmail.com');
        $mail->addAddress($email);     //Add a recipient
        
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'noreply';
    
        $text = "
            <h2>Xin chào</h2>
            <h5>Đổi mật khẩu mới.</h5>
            <br><br>
            <a href='http://localhost/website/app/views/LoginAndSignup/resetPassword.php?code=$code'>Click me</a>
        ";
    
        $mail->Body    = $text;
       
        $mail->send();
    }
