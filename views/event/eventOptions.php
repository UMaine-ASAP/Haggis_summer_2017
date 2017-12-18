<div id='eventOptions' class='popup'>
  <div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
  <h2>Event Options</h2>
  <hr>
  <?php

    echo "Share this link with event participants to allow them to register their projects with this event.<br>
      <input  disabled size='75' id='copiablereglink' value='http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerEvent&target=".$event->id."'>
      <button onclick='copy()'>Copy Link</button>";

      echo "<hr>";

    if($event->active)
      echo "<a href='?controller=event&action=setActive&eventid=".$event->id."&status=0'>
            <input class='standard' type='button' value='Set Event inactive'>
            </a>";
    else
      echo "<a href='?controller=event&action=setActive&eventid=".$event->id."&status=1'>
            <input class='standard' type='button' value='Set Event active'>
            </a>";
  ?>
</div>

<script>
function copy() {
  var copyText = document.getElementById("copiablereglink");
  copyText.select();
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>