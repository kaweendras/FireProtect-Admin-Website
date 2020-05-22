<?php
include 'header.php';
include 'connection.php';
$id=$_GET["id"];


$res= mysqli_query($link,"SELECT * FROM devices WHERE did = $id");
$row=mysqli_fetch_array($res);

?>
  <title>Edit Device</title>
          <style>
          body { margin: 0; padding: 0; }
          #map { position: absolute ; top: 60px; bottom: 0; left:50%; width: 50%; }
        </style>
        </head>
        <body>
        <style>
        .coordinates {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        bottom: 40px;
        left: 53%;
        padding: 5px 10px;
        margin: 0;
        font-size: 11px;
        line-height: 18px;
        border-radius: 3px;
        display: none;
        }
        </style>
        
        <div id="map"></div>
        <pre id="coordinates" class="coordinates"></pre>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Device</h4>
                            </div>
                            <div class="content">
                                <form method="POST" id = "form1" name="form1">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Device Name</label>
                                                <input type="text" class="form-control" placeholder="Device Name" name="name" value ="<?php echo $row["name"] ?>" required>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" placeholder="Description" name ="descr" value ="<?php echo $row["descr"] ?>" required>
                                            </div>
                                        </div>
                                      
                                    </div>

                                   <label><b>Select Location using the Map</b></label>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <input type="text" class="form-control" placeholder="Longitude" id="lon" name="lon" value ="<?php echo $row["lon"] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <input type="text" class="form-control" placeholder="Latitude" id="lat"  name="lat" value ="<?php echo $row["lat"] ?>" required>
                                            </div>
                                        </div>
                                       
                                    </div>


                                    
                                    <input type="submit" class="btn btn-info btn-fill " value="Update" name = "submit1" >
                                    <input type="submit" class="btn btn-danger btn-fill " value="Delete" name = "submit2" >
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

 
            if(!mysqli_query($link," UPDATE devices SET name = '$_POST[name]', descr = '$_POST[descr]',lon = '$_POST[lon]', lat = '$_POST[lat]' WHERE did = '$id'"))
          
          {
          echo("Error description: " . mysqli_error($link));
          
          }
      
      
          ?>
          <script>
              alert("Device Updated Successfully");
              window.location = "manage_devices.php";
      
              
              
              
          </script>
      
              <?php
      
      
      
      
      
              }
      
      
              ?>
 <?php
        if(isset($_POST["submit2"])){

 
            
            if(!mysqli_query($link," DELETE FROM devices WHERE did = '$id'"))
          
          {
          echo("Error description: " . mysqli_error($link));
          
          }
      
      
          ?>
          <script>
              alert("Device Deleted Successfully");
              window.location = "manage_devices.php";
      
              
              
              
          </script>
      
              <?php
      
      
      
      
      
              }
      
      
              ?>





        
        <script>
          mapboxgl.accessToken = 'pk.eyJ1Ijoic2FsaXRoYWsxIiwiYSI6ImNrODQ3bmY0bjExNGYzZnBndmRrbjJmZmgifQ.WbEDNbU0ua0PTSJQtbttOA';
        var coordinates = document.getElementById('coordinates');
        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/salithak1/ck9mszvw441lh1iqo51a2xbr4',
        center: [80.771797, 7.873054],
        zoom: 7.5
        });
        
        var canvas = map.getCanvasContainer();
        
        var geojson = {
        'type': 'FeatureCollection',
        'features': [
        {
        'type': 'Feature',
        'geometry': {
        'type': 'Point',
        'coordinates': [<?php echo $row["lon"] ?>, <?php echo $row["lat"] ?>]
        }
        }
        ]
        };
        
        function onMove(e) {
        var coords = e.lngLat;
        
        // Set a UI indicator for dragging.
        canvas.style.cursor = 'grabbing';
        
        // Update the Point feature in `geojson` coordinates
        // and call setData to the source layer `point` on it.
        geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
        map.getSource('point').setData(geojson);
        }
        
        function onUp(e) {
        var coords = e.lngLat;
        
        // Print the coordinates of where the point had
        // finished being dragged to on the map.
        coordinates.style.display = 'block';
        coordinates.innerHTML =
        'Longitude: ' + coords.lng + '<br />Latitude: ' + coords.lat;
        
        document.getElementById("lon").value = coords.lng;
        
        document.getElementById("lat").value = coords.lat;
        
        // Unbind mouse/touch events
        map.off('mousemove', onMove);
        map.off('touchmove', onMove);
        }
        
        map.on('load', function() {
        // Add a single point to the map
        map.addSource('point', {
        'type': 'geojson',
        'data': geojson
        });
        
        map.addLayer({
        'id': 'point',
        'type': 'circle',
        'source': 'point',
        'paint': {
        'circle-radius': 10,
        'circle-color': '#3887be'
        }
        });
        
        // When the cursor enters a feature in the point layer, prepare for dragging.
        map.on('mouseenter', 'point', function() {
        map.setPaintProperty('point', 'circle-color', '#3bb2d0');
        canvas.style.cursor = 'move';
        });
        
        map.on('mouseleave', 'point', function() {
        map.setPaintProperty('point', 'circle-color', '#3887be');
        canvas.style.cursor = '';
        });
        
        map.on('mousedown', 'point', function(e) {
        // Prevent the default map drag behavior.
        e.preventDefault();
        
        canvas.style.cursor = 'grab';
        
        map.on('mousemove', onMove);
        map.once('mouseup', onUp);
        });
        
        map.on('touchstart', 'point', function(e) {
        if (e.points.length !== 1) return;
        
        // Prevent the default map drag behavior.
        e.preventDefault();
        
        map.on('touchmove', onMove);
        map.once('touchend', onUp);
        });
        });
        </script>



            <?php
            include 'footer.php'
            ?>
