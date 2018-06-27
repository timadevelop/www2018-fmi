<div class="hidden" id="modify-trip-transport">
  <p>Choose the way to travel: </p>
    <?php $opt = $trip->transport;  ?>
  <select name="transport-list" id="transport_selection" onchange="filter(this.options[this.selectedIndex].value)">
    <option value="own" <?php if($opt == 'own') echo 'selected'; ?>>own</option>
    <option value="rent-a-car" <?php if($opt == 'rent-a-car') echo 'selected'; ?>>rent-a-car</option>
    <option value="taxi" <?php if($opt == 'taxi') echo 'selected'; ?>>taxi</option>
    <option value="bike" <?php if($opt == 'bike') echo 'selected'; ?>>bike</option>
  </select>
  <ul id="transport_list">
    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">rent-a-car</p>
        <p class="flex2">Mercedes Benz E200</p>
        <p class="flex1">30$/day</p>
        <p class="flex2">provided by Rcar Ltd.</p>

        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">rent</i>
            <i class="fa fa-trash">hide</i>
        </div>
        </div>
    </li>
  </ul>
</div>
