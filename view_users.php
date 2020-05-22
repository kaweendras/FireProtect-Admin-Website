<?php
include 'header.php';
include 'connection.php';

$res=mysqli_query($link,"SELECT * FROM users");
?>
<title>View Users</title>


<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Users</h4>
                                <p class="category">All Users</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>UID</th>
                                    	<th>First Name</th>
                                    	<th>Last Name</th>
                                    	<th>Username</th>
                                    	<th>Email</th>
                                        <th>Contact No</th>
                                    	<th>Address</th>
                                        <th>NIC/Passport</th>
                                    	
                                    </thead>
                                    <tbody>

                                    <?php
                                    while($row=mysqli_fetch_array($res))
                                     {
                                       echo "<tr>";
                                            echo "<td>"; ?> <a href="edit_devices.php?id=<?php echo $row["uid"]; ?>"style="color: Blue;"><?php echo  $row["uid"];  ?></a> <?php   echo "</td>";
                                        	echo "<td>"; ?> <a href="edit_devices.php?id=<?php echo $row["uid"]; ?>"style="color: Blue;"><?php echo  $row["fname"];  ?></a> <?php   echo "</td>";
                                        	echo "<td>"; echo $row["lname"]; echo "</td>";
                                        	echo "<td>"; echo $row["username"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["phone"]; echo "</td>";
                                            echo "<td>"; echo $row["address1"]; echo "</td>";
                                            echo "<td>"; echo $row["nic"]; echo "</td>";
                                       echo "</tr>";
                                        
                                     }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    


                </div>
            </div>
        </div>









<?php
include 'footer.php';
?>