<?php 

include 'header.php';
include 'connection.php';
//sql queries to get counts
$res= mysqli_query($link,"SELECT * FROM devices");

$res1 = mysqli_query($link,"SELECT COUNT(did) AS count_devices FROM devices");
$row1 = mysqli_fetch_array($res1);

$res2 = mysqli_query($link,"SELECT COUNT(uid) AS count_users FROM users");
$row2 = mysqli_fetch_array($res2);


$res3 = mysqli_query($link,"SELECT name FROM devices ORDER BY did DESC LIMIT 1");
$row3 = mysqli_fetch_array($res3);

$res4 = mysqli_query($link,"SELECT fname FROM users ORDER BY uid DESC LIMIT 1");
$row4 = mysqli_fetch_array($res4);

$res5 = mysqli_query($link,"SELECT count(id) as count_users  FROM appuser");
$row5 = mysqli_fetch_array($res5);
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</script>
<style>
        body {
          margin: 0;
          padding: 0;
        }
  
        #map {
          position: absolute;
          top: 60px;
          left: 67%;
          bottom: 0;
          height: 897px;
          width: 530px;
          
        }
  
        .marker {
          background-image: url('assets/img/marker.png');
          background-size: cover;
          width: 50px;
          height: 50px;
          border-radius: 50%;
          cursor: pointer;
          }
  
          .mapboxgl-popup {
              max-width: 200px;
              }
  
              .mapboxgl-popup-content {
              text-align: center;
              font-family: 'Open Sans', sans-serif;
              }

              .size1 {
                font-size: 50px;
              }
   
        
        
  
      </style>









 <!--- your code start-->
 <div id="map"></div>

    <div style="top:500px;">
        <div class="card border-success bg-transparent mb-3" style="width: 18rem; height: 15rem;  position:absolute; left:40px;">
        
        <div class="card-body text-success">
            <h5 class="card-title">No of Devices</h5>
            <div class="size1"><center><?php echo $row1["count_devices"];?></center></div>
        </div>
        </div>

        <div class="card border-primary bg-transparent mb-6" style="width: 18rem; height: 15rem; position:absolute; left:328px;">

        <div class="card-body text-primary">
            <h5 class="card-title">No of Users</h5>
            <div class="size1"><center><?php echo $row2["count_users"];?></center></div>
        </div>
            </div>

            <div class="card border-danger bg-transparent mb-6" style="width: 18rem; height: 15rem; position:absolute; left:610px;">

        <div class="card-body text-danger">
            <h5 class="card-title">No of App Users</h5>
            <div class="size1"><center><?php echo $row5["count_users"];;?></center></div>
        </div>
            </div>

    </div>


    <div style="top:350px; position:relative">
        <div class="card border-warning bg-transparent mb-3" style="width: 18rem; height: 15rem; position:absolute; left:40px;">
        
        <div class="card-body text-warning">
            <h5 class="card-title">Latest device</h5>
            <div style="font-size: 35px;"><center><?php echo $row3["name"];?></center></div>
        </div>
        </div>

        <div class="card border-info bg-transparent mb-6" style="width: 18rem; height: 15rem; position:absolute; left:328px;">

        <div class="card-body text-info">
            <h5 class="card-title">Last Users</h5>
            <div style="font-size: 35px;"><center><?php echo $row4["fname"];?></center></div>
        </div>
            </div>

           

    </div>





        <script>

            mapboxgl.accessToken = 'pk.eyJ1Ijoic2FsaXRoYWsxIiwiYSI6ImNrODQ3bmY0bjExNGYzZnBndmRrbjJmZmgifQ.WbEDNbU0ua0PTSJQtbttOA';
            
            var map = new mapboxgl.Map({
              container: 'map',
              style: 'mapbox://styles/salithak1/ck9mszvw441lh1iqo51a2xbr4',
              center: [80.771797, 7.873054],
              zoom: 7
            });
            
            
            var geojson = {
              type: 'FeatureCollection',
              features: [


                <?php
                while ($row = mysqli_fetch_array($res)){ ?>
                
                {
                
                type: 'Feature',
                geometry: {
                  type: 'Point',
                  coordinates: [<?php echo  $row["lon"]; ?>, <?php echo  $row["lat"]; ?>]
                },
                properties: {
                  title:' <?php echo  $row["name"]; ?>',
                  description: '<?php echo  $row["descr"]." <a href=edit_devices.php?id=$row[did]>edit</a>" ?>'
                }
              },

             <?php 
            }?>
              
              ]
            };
            
            // add markers to map
            geojson.features.forEach(function(marker) {
            
            // create a HTML element for each feature
            var el = document.createElement('div');
            el.className = 'marker';
            
            // make a marker for each feature and add to the map
            new mapboxgl.Marker(el)
              .setLngLat(marker.geometry.coordinates)
              .setLngLat(marker.geometry.coordinates)
              .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
              .addTo(map);
            });
            
            
            
            // code from the next step will go here!
            
            </script>
            <!--- your code ends-->


<?php 

include 'footer.php'

?>