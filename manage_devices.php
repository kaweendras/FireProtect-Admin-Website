<?php
include 'header.php';
include 'connection.php';

$res=mysqli_query($link,"SELECT * FROM devices");
?>

<title>Manage Devices</title>

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Devices</h4>
                                <p class="category">All Devices</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Device Name</th>
                                    	<th>Description</th>
                                    	<th>Longitude</th>
                                    	<th>Latitude</th>
                                    </thead>
                                    <tbody>

                                    <?php
                                    while($row=mysqli_fetch_array($res))
                                     {
                                       echo "<tr>";
                                            echo "<td>"; ?> <a href="edit_devices.php?id=<?php echo $row["did"]; ?>"style="color: Blue;"><?php echo  $row["did"];  ?></a> <?php   echo "</td>";
                                        	echo "<td>"; ?> <a href="edit_devices.php?id=<?php echo $row["did"]; ?>"style="color: Blue;"><?php echo  $row["name"];  ?></a> <?php   echo "</td>";
                                        	echo "<td>"; echo $row["descr"]; echo "</td>";
                                        	echo "<td>"; echo $row["lon"]; echo "</td>";
                                        	echo "<td>"; echo $row["lat"]; echo "</td>";
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