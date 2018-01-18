
<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>New User Registration</h2><hr>

Are you sure you wish to delete this assignment?<br>
<form method="post" action='?controller=assignment&action=delete'>
  <input type='hidden' name='assignmentid' value='<?php echo $a->id;?>'>
  <input type='hidden' name='classID' value='<?php echo $classID;?>'>
<input type='submit' class='standard' value='Yes'></form>
<button class ='exit standard'>Cancel</button>
