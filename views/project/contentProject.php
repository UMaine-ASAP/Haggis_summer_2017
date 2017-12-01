<h3>Project Contents</h3>



<?php
echo $userID."<br>";
foreach($ids as $i)
{
  echo $i."<br>";
}
if($assignedUser)
  echo "You are assigned to this project";
else
  echo "You are Not assigned to this project";
