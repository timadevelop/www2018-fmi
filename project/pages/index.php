<?php include_once("parts/header.php") ?>
   <div class="flex space-between horizontal">
      <a href="trips.html" class="bold">Back to Trips</a>
      <a href="trips.html" class="bold">Remove this trip</a>
    </div>
    <div>
      <div class="trip">
        <div class="flex space-between vertical">
        <hr>
          <div class="trip-navigation">
            <nav class="flex horizontal space-around">
              <a onclick="changeTab(this, 'modify-trip-scenario')" class="selected">Scenario</a>
              <a onclick="changeTab(this, 'modify-trip-transport')">Transport</a>
              <a onclick="changeTab(this, 'modify-trip-checklist')">Checklist</a>
              <a onclick="changeTab(this, 'modify-trip-services')">Services</a>
              <a onclick="changeTab(this, 'modify-trip-tasks')">Tasks</a>
              <a onclick="changeTab(this, 'modify-trip-travelers')">Travelers</a>
            </nav>

          </div>
        </div>
      </div>

  </div>




<?php include_once("parts/footer.php") ?>
