<div class="hidden" id="modify-trip-transport">
  <p>Choose the way to travel: </p>
  <select name="transport-list" id="transport_selection" onchange="filter(this.options[this.selectedIndex].value)">
    <option value="own">own</option>
    <option value="rent-a-car">rent-a-car</option>
    <option value="taxi">taxi</option>
    <option value="bike">bike</option>
  </select>
  <ul id="transport_list">
    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">own</p>
        <p>Ok, you can find it yourself</p>
      </div>
    </li>
    <!-- rent a car -->
    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">rent-a-car</p>
        <p class="flex2">BMW e39</p>
        <p class="flex1">20$/day</p>
        <p class="flex2">provided by Rcar Ltd.</p>
        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">rent</i>
            <i class="fa fa-trash">hide</i>
        </div>
      </div>
    </li>
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
    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">rent-a-car</p>
        <p class="flex2">Mazda 3</p>
        <p class="flex1">15$/day</p>
        <p class="flex2">provided by rentMe Ltd.</p>
        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">rent</i>
            <i class="fa fa-trash">hide</i>
        </div>
      </div>
    </li>
    <!-- taxi -->

    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">taxi</p>
        <p class="flex2">from airport</p>
        <p class="flex1">1$/mile</p>
        <p class="flex2">provided by taxLw Ltd.</p>
        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">get</i>
            <i class="fa fa-trash">hide</i>
        </div>
      </div>
    </li>

    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">taxi</p>
        <p class="flex2">from bus station</p>
        <p class="flex1">0.7$/mile</p>
        <p class="flex2">provided by taxLw Ltd.</p>
        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">get</i>
            <i class="fa fa-trash">hide</i>
        </div>
      </div>
    </li>


    <!-- bike -->

    <li class="transport_item">
      <div class="flex space-between horizontal">
        <p class="type">bike</p>
        <p class="flex2">ELECTRIFIED bike share</p>
        <p class="flex1">1$/hour</p>
        <p class="flex2">provided by JUMP Ltd.</p>
        <div class="flex flex2 flex-end horizontal">
            <i class="fa fa-check">get</i>
            <i class="fa fa-trash">hide</i>
        </div>
      </div>
    </li>
  </ul>
</div>
