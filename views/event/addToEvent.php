<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>Add <?php echo $a->title; ?> to Event</h2><hr>

<form method='post' action='?controller=event&action=addAssignment'>
  <select name='event'>
    <?php
    foreach($e as $event)
    {
      echo "<option value='".$event->id."'>".$event->title."</option>";
    }
    ?>
  </select><br>
  <input type='hidden' name ='assignmentID' value='<?php echo $a->id; ?>'>
  <input type='hidden' name ='classid' value='<?php echo $classID;?>'>
  <input type='submit' value='Submit'>
</form>


  <datalist id='eventList'>

  </datalist>
