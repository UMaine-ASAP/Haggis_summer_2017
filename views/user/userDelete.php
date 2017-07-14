<?php
echo $message;
if(!$userSelected)
{
  echo "<form action='?controller=user&action=delete' method='post'>";
  echo "<select name='user'>";
  foreach($userList as $user)
  {
    echo "<option value='".$user->id."'>".$user->firstName." ".$user->middleInitial." ".$user->lastName."</option>";
  }
  echo "</select>";
  echo "<input type='submit' value='Submit'></form></div>";

}

else
{
  echo "<form action='?controller=user&action=delete' method='post'>";
  echo "<input type='hidden' name='userid' value='".$selectedUser->id."'>";
  echo "Do you wish to delete ". $selectedUser->firstName." ". $selectedUser->middleInitial." ".$selectedUser->lastName."?";
  echo "<select name ='confirm'>";
  echo "<option value='no' selected>No</option>";
  echo "<option value='yes'>Yes</option>";
  echo "</select>";
  echo "<input type='submit' value='Confirm'>";
  echo "</form>";

}


?>
