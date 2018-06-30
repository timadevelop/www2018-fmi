<div id="modify-trip-scenario">

  <!-- <p>input here points(point 2.3)</p> -->
  <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/directions?origin=Sofia&destination=London&key=AIzaSyC3enjNB85Q9RzgtQgE82eg5E8K8w0Wloc" allowfullscreen id="map">
</iframe>
  <p>Here is a trip scenario, you can change it!</p>
  <ul id="scenario-list">
    <?php foreach (json_decode($trip->scenario) as $item): ?>
      <li><?=$item?></li>
    <?php endforeach; ?>
  </ul>
</div>



    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          // zoom: 6,
          // center: {lat: 41.85, lng: -87.65}
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var pts = ["Paris", "Berlin"];
        for (var i = 0; i < pts.length; i++) {
            waypts.push({
              location: pts[i],
              stopover: true
            });
        }

        directionsService.route({
          origin: "Sofia",
          destination: "London",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            // var route = response.routes[0];
            // var summaryPanel = document.getElementById('directions-panel');
            // summaryPanel.innerHTML = '';
            // For each route, display summary information.
            // for (var i = 0; i < route.legs.length; i++) {
            //   var routeSegment = i + 1;
            //   summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
            //       '</b><br>';
            //   summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
            //   summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
            //   summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            //}
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3enjNB85Q9RzgtQgE82eg5E8K8w0Wloc&callback=initMap">
    </script>
