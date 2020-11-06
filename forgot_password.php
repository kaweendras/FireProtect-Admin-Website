<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password|LMS</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>
<style>
    .form-gap {
    padding-top: 70px;
}
</style>
<body>

 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="form" role="form" autocomplete="off" name="form1" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>

                    <?php
                    if(isset($_POST["recover-submit"])){
                      //echo $_POST["email"];

                      $res = mysqli_query($link,"SELECT * FROM users WHERE email = '$_POST[email]';");
                      $row = mysqli_fetch_array($res);

                      if(empty($row)){
                          echo '<span style="color: red;">Incorrect E-mail.Please try Again.</span>';
                      }else{
                        $key = rand(100001, 999999);

                        //delete existing keys
                        mysqli_query($link,"DELETE FROM reset WHERE email ='$_POST[email]'");

                        mysqli_query($link,"INSERT INTO reset VALUES('','$_POST[email]','$key')");

                        //email function starts
                        $mail = new PHPMailer;

                        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = '';                 // SMTP username
                        $mail->Password = '';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom('no-reply@fireprotect.lk', 'FireProtect');
                        $mail->addAddress($_POST["email"]);     // Add a recipient
                        
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Password Reset';
                        $mail->Body    = 'Your Verification Code is <b>' .$key. ' </b> ';
                        $mail->AltBody = 'Your Verification Code is <b>' .$key. ' </b> ';

                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                          header("Location: reset-code.php?email=".$_POST["email"]);
                        exit();
                            echo 'Message has been sent';
                        }

                        //email function ends

                        
                      }
                      
                    }
                    ?>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</body>
</html>