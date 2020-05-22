<?php
require_once 'PHPMailer/PHPMailerAutoload.php';
include 'header.php';
include 'connection.php';
?>
<title>Add Users</title>


<div class="content" style="left:100px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add a New User</h4>
                            </div>
                            <div class="content">
                                <form method="POST" id = "form1" name="form1">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="fname" required>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="lasrt Name" name ="lname" required>
                                            </div>
                                        </div>
                                      
                                    </div>


                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>UserName</label>
                                                <input type="text" class="form-control" placeholder="Username" name ="uname" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name ="email" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Contact No</label>
                                                <input type="text" class="form-control" placeholder="Phone No" name ="phone" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Address" name ="address1" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>NIC/Passport No</label>
                                                <input type="text" class="form-control" placeholder="NIC/Passport No" name ="nic" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                  

                                    


                                    
                                    <input type="submit" class="btn btn-info btn-fill " value="Add User" name = "submit1" >
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                   

                </div>
            </div>
        </div>


        <!-- SQL query -->

        <?php
        if(isset($_POST["submit1"])){

            //generating random number

            $key = rand(100001, 999999);
            
            //md5 hashing
            $password1 = md5($key);


            $res5 = mysqli_query($link,"SELECT * from users where email = '$_POST[email]'");
            $res6 = mysqli_query($link,"SELECT * from users where phone = '$_POST[phone]'");
            $res8 = mysqli_query($link,"SELECT * from users where username = '$_POST[uname]'");
            $res9 = mysqli_query($link,"SELECT * from users where nic = '$_POST[nic]'");



            if(mysqli_num_rows($res5) !== 0){
                ?>
                    <script>
                        alert("This E-mail has already been used");
                        window.location="add_users.php";
                        
                        
                        
                    </script>
    
                        <?php
                        
    
            }elseif(mysqli_num_rows($res6) !== 0){
                ?>
                    <script>
                        alert("This Phone number has already been used");
                        window.location="add_users.php";
                        
                        
                        
                    </script>
    

    
                    <?php
            }elseif(mysqli_num_rows($res8) !== 0){
                ?>
                <script>
                    alert("This Username has already been used");
                    window.location="add_users.php";
                    
                    
                    
                </script>
    
                    <?php
            }elseif(mysqli_num_rows($res9) !== 0){
                ?>
                <script>
                    alert("This NIC/Passport has already been used");
                    window.location="add_users.php";
                    
                    
                    
                </script>
    
                    <?php
            }else{

 
                        if (!mysqli_query($link,"INSERT into users (fname,lname,email,address1,phone,nic,username,password) values('$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[address1]','$_POST[phone]','$_POST[nic]','$_POST[uname]','$password1')"))
                        
                        {
                        echo("Error description: " . mysqli_error($link));
                        
                        }else{

                            //success

                            //email function starts
                            $mail = new PHPMailer;

                            $mail->SMTPDebug = 3;                               // Enable verbose debug output

                            $mail->isSMTP();                                       // Set mailer to use SMTP
                            $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'salithak3@gmail.com';                 // SMTP username
                            $mail->Password = 'rexgentium...';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to

                            $mail->setFrom('no-reply@fireprotect.lk', 'FireProtect');
                            $mail->addAddress($_POST["email"]);     // Add a recipient
                            
                            $mail->isHTML(true);                                  // Set email format to HTML

                            $mail->Subject = 'New Account Created';
                            $mail->Body    = 'Your account has been Created. Use <b>' .$_POST["uname"]. ' </b> as  your username and <b>' .$key. ' </b> as your Password to Log on to the system.';
                            $mail->AltBody = 'Your account has been Created. Use <b>' .$_POST["uname"]. ' </b> as  your username and <b>' .$key. ' </b> as your Password to Log on to the system.';

                            if(!$mail->send()) {
                                //if(false) {
                                    echo 'Message could not be sent.';
                                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                                }else {
                                    ?>
                                    <script>
                                        alert("User Registered Successfully");
                                
                                        window.location="add_users.php";
                                        
                                        
                                    </script>
                    
                                        <?php
                    
                            }
                        
                        
                    
                        }
                    
      
      
              }
            }
      
      
              ?>





<?php
include 'footer.php';
?>