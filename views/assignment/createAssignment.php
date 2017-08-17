<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>Create an Assignment</h2><hr>

<form action='?controller=assignment&action=createAssignment' method='post'>
  <input class='standard' type='hidden' name='classid' value='<?php echo $class->id; ?>'>
  <input class='standard' type='text' name='title' placeholder="Assignment's title"><br>
  <textarea class='standard' name='description' cols=25 rows=10 placeholder="Assignment's Description"></textarea><br>
  Due Date:<input class='standard' type='date' name='duedate'><br>
  Due Time:<input class='standard' type='time' name='duetime'><br>
  <input class='standard' type='submit' value='Add Assignment'>
</form>
