<?php
if($userEdited)
{
  echo "<div>User has been updated</div>";
}
if(!$userSelected)
{
  echo "<div>SELECT A USER<br><br>";
  echo "<form action='?controller=user&action=editUser' method='post'>";
  echo "<select name='user'>";
  foreach($userList as $user)
  {
    echo "<option value='".$user->id."'>".$user->firstName."</option>";
  }
  echo "</select>";
  echo "<input type='submit' value='Submit'></form></div>";

}

else
{
  echo "<form action='?controller=user&action=editUser' method='post'>";
  echo "<input type='hidden' name='userid' value='".$selectedUser->id."'>";
  echo "<input type='text' name='firstname' value='".$selectedUser->firstName."'>";
  echo "<input type='text' size='1' maxlength='1' name='middleinitial' value='".$selectedUser->middleInitial."'>";
  echo "<input type='text' name='lastname' value='".$selectedUser->lastName."'><br>";
  echo "<input type='email' name='email' value='".$selectedUser->email."'><br>";
  echo "<select name='usertype'>";
  if($selectedUser->usertype == "admin")
  {
    echo "<option value='admin' selected>Administrator</option>";
    echo "<option value='user'>User</option>";
  }
  else
  {
    echo "<option value='admin'>Administrator</option>";
    echo "<option value='user' selected>User</option>";
  }
  echo "</select><br>";
  echo "<input type='submit' value='Modify User'>";
  echo "</form>";

}


?>
