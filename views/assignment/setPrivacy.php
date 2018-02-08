<div class='exit' onclick='closePopup("setPrivacy")'><i class="glyphicon glyphicon-remove"></i></div>
<h2>Set Privacy</h2><hr>
This will change the accessability of responses by the students.<br>
<form method='post' action='?controller=assignment&action=setPrivacy'>
  <input type='hidden' name='assignmentID' value='<?php echo $a->id; ?>'>
  <input type='hidden' name='classID' value='<?php echo $a->classID;?>'>
<?php
  if($a->privacy == '1')
  {
    echo "Privacy is currently active. Do you wish to disable? <br> <input type='hidden'  name='status' value='0'><br><input class='standard' type='submit' value='Deactive Privacy Mode'>";
  }
  else
  {
    echo "Privacy is currently not active.<br><input type ='hidden' name='status' value='1'> <br> <input class='standard' type='submit' value='Activate Privacy Mode'>";
  }
  ?>
</form>
