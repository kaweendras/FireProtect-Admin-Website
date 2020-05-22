<?php
include 'connection.php';
$email =$_GET["email"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify|LMS</title>
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
                  <h2 class="text-center">E-mail Verification</h2>
                  <p>Please insert the code that we have sent your E-mail address.</p>
                  <div class="panel-body">
    
                    <form id="form" role="form" autocomplete="off" name="form1" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="key" name="key" placeholder="Verification Code" class="form-control"  type="text">
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

                      $res = mysqli_query($link,"SELECT * FROM reset WHERE email = '$email';");
                      $row = mysqli_fetch_array($res);

                      if($_POST["key"]== $row["key"]){
                        header("Location: reset-pass.php?email=".$email);
                        exit(); 
                      }else{
                        
                        echo '<span style="color: red;">Incorrect Verification code.Please try Again or start over.</span>';
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