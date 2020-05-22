<?php
include 'header.php';
include 'connection.php';

$res= mysqli_query($link,"SELECT * FROM devices");

?>

<style>
        body {
          margin: 0;
          padding: 0;
        }
  
        #map {
          position: absolute;
          top: 60px;
          left: 0;
          bottom: 0;
          width: 100%;
          
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
  
      </style>
  <title>Device Map</title>
        <!--- your code start-->
        <div id="map"></div>
        <script>

            mapboxgl.accessToken = 'pk.eyJ1Ijoic2FsaXRoYWsxIiwiYSI6ImNrODQ3bmY0bjExNGYzZnBndmRrbjJmZmgifQ.WbEDNbU0ua0PTSJQtbttOA';
            
            var map = new mapboxgl.Map({
              container: 'map',
              style: 'mapbox://styles/salithak1/ck9mszvw441lh1iqo51a2xbr4',
              center: [80.771797, 7.873054],
              zoom: 7.5
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
