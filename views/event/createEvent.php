<script src='java/formScaler.js'></script>
<div class='exit'>
  <i class="glyphicon glyphicon-remove"></i>
</div>
<h2>Event Mode</h2>
<hr class='minor'>

By activating event mode, this will allow anyone using Haggis to review the current assignment you have selected.
<br><br>
<form action='?controller=event&action=add' method='post'>
  <input class='standard' type='text' name='title'><br>
  <textarea class='standard' rows='5' cols='50' name='description'></textarea><br>
  Start Time <input class='standard' type='time' name='startTime'>
  End Time   <input class='standard' type='time' name='endTime'><br>
  Start Date <input class='standard' type='date' name='startDate'>
  End Date   <input class='standard' type='date' name='endDate'><br>
  Make this event Active now?<br>
  No <input class='standard' type='radio' name='active' value='0'>
  Yes <input class='standard' type='radio' name='active' value='1'><br>


  <div class='eventCreationCritera'>
    <br><br>
    <?php echo $criteriaList; ?>
    <?php require_once('views/criteria/createCriteria.php'); ?>
  </div>


  <input type='submit' class='standard' value='create this event'>
</form>
