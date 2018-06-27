<div class="hidden" id="modify-trip-checklist">
<p>Create a checklist of stuff you need and set alarms/notifications for yourself or other travelers</p>
  <div class="flex center-content horizontal">
    <input onkeypress="if (event.keyCode == 13) add(event,  'trip_checklist', 'newChecklistItemInput')" id="newChecklistItemInput" class="flex4" type="text" />
    <button onclick="add(event, 'trip_checklist', 'newChecklistItemInput')" class="button flex1">Add</button>
  </div>
  <ul class="trip-checklist" id="trip_checklist">
    <?php foreach (json_decode($trip->checklist) as $item): ?>
      <li onclick="toogleDone(event)">
        <p><?=$item?></p>
        <i onclick="remove(<?=$item?>, event)" class="fa fa-trash"></i>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
<script src="../dist/js/itemsList.js"></script>

