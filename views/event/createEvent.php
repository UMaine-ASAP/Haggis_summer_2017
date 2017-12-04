<script src='java/formScaler.js'></script>
<div class='exit'>
  <i class="glyphicon glyphicon-remove"></i>
</div>
<h2>Event Mode</h2>
<hr class='minor'>

By activating event mode, this will allow anyone using Haggis to review the current assignment you have selected.
<br><br>
<form action='?controller=event&action=add' method='post'>
  <input type='hidden' name='assignmentID' value='<?php echo $a->id; ?>'>
  <input type='submit' class='standard' value='begin the event'>
</form>
