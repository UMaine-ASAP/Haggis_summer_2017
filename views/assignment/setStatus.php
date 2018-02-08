
<div class='exit' onclick='closePopup("setActive")'><i class="glyphicon glyphicon-remove"></i></div>
<h2>Set Status</h2><hr>
This will change the visibility of this asisgnment to your students.<br>
<form method='post' action='?controller=assignment&action=setStatus'>
  <input type='hidden' name='assignmentID' value='<?php echo $a->id; ?>'>
  <input type='hidden' name='classID' value='<?php echo $a->classID;?>'>
<?php
  if($a->assigned == '1')
  {
    echo "Do you wish to deactivate this assignment, making it invisible to students?<br><input type='hidden'  name='status' value='0'><br><input class='standard' type='submit' value='Deactive Assignment'>";
  }
  else
  {
    echo "Do you wish to activate this assignment, making it visible to students?<br><input type ='hidden' name='status' value='1'><br><input class='standard' type='submit' value='Activate Assignment'>";
  }
  ?>
