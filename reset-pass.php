<?php
include 'connection.php';
$email =$_GET["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password|LMS</title>
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
                  <h3><i class="fa fa-key fa-4x"></i></h3>
                  <h2 class="text-center">Reset Password</h2>
                  <p>Password must be atleast 8 characters</p>
                  <div class="panel-body">
    
                    <form id="form" role="form" autocomplete="off" name="form1" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="pass1" name="pass1" placeholder="New Password" class="form-control"  type="password">
                        </div><br>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="pass2" name="pass2" placeholder="Re-Enter the password" class="form-control"  type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>

                    <?php
                    if(isset($_POST["recover-submit"])){
                      

                      if($_POST["pass1"] != $_POST["pass2"]){
                        echo '<span style="color: red;">Passwords do not match.</span>';
                      }elseif(strlen($_POST["pass1"])< 8){
                        echo '<span style="color: red;">Password must be atleast 8 characters.</span>';
                      }else{
                        //echo 'all matches';

                        $password = md5($_POST["pass1"]);
                        if(!(mysqli_query($link,"UPDATE users SET password ='$password' WHERE email ='$email'"))){
                          echo '<span style="color: red;">Error,Please try again!.</span>';
                        }else{
                          mysqli_query($link,"DELETE FROM reset WHERE email ='$email'");
                          ?>
            
                            <script type="text/javascript">
                            alert("Password resetted Successfully!");
                            window.location="../login.php";
                            </script>
                        
                        <?php

                        }
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