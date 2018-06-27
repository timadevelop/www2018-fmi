
<div class="hidden" id="modify-trip-tasks">
  <p>TODO list for your trip.</p>
  <p>set priority, deadline and notifications for these TODOs</p>
  <div class="flex center-content horizontal">
    <input onkeypress="if (event.keyCode == 13) add(event,  'trip_tasks_list', 'newTaskInput')" id="newTaskInput" class="flex4" type="text" />
    <button onclick="add(event, 'trip_tasks_list', 'newTaskInput')" class="button flex1">Add</button>
  </div>
  <ul class="trip-tasks" id="trip_tasks_list">
    <?php foreach (json_decode($trip->tasks) as $item): ?>
      <li onclick="toogleDone(event)">
        <p><?=$item?></p>
        <i onclick="remove(<?=$item?>, event)" class="fa fa-trash"></i>
      </li>
    <?php endforeach; ?>
  </ul>

  <script src="../dist/js/itemsList.js"></script>
  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="notification-time flex vertical">
        <label for="appt-time">Choose notification time: </label>
        <input id="appt-time" type="time" name="appt-time" value="13:30">
        <input type="submit" value="submit"/>
      </div>
    </div>

  </div>
</div>
