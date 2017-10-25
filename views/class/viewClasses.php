

<?php
echo "<div id='assignmentcreator'>";
require_once('views/assignment/createAssignment.php');
echo "</div>";

foreach($assignments as $a)
{
  echo "<div class='assignment' id='id".$a->id."'><table><tr><td>";
  foreach($a->projects as $p)
  {
    echo "<ul>";
    $list = $p->list;
    if($p->isgroup === '0')
    {

      foreach($list as $u)
      {
        $user = $u->userID;
        echo "<li><a href='#'>".$user->firstName." ".$user->lastName."</a></li>";
      }
    }
    else
    {
      foreach($list as $g)
      {
        echo "<li><a href='#'>".$g->studentGroupID."</a></li>";
      }
    }
    echo "</ul>";
  }
  echo "</td><td>";

  echo "
  <div >";
  if($status === 'admin')
  {
    echo "
    <form action ='?controller=assignment&action=editAssignment' method ='post'>
    <button class='standard' value= '".$a->id."' name='assignmentid' type='submit'>Edit Assignment</button>
    </form>
    <button class='standard' id='delete' name='".$a->id."' type='button'>Delete Assignment</button>";
  }

  echo "<h2>".$a->title."</h2><hr>
  <div>Due Date:".$a->duedate."
  Prompt: ".$a->description."<hr>
  This assignment will be graded on the following criteria:<br><br>";
  foreach($a->criterias as $c)
  {
    echo "<strong>".$c->title."</strong> on scale of ".$c->minRange." to ".$c->maxRange."<br>".$c->description."<br>";

  }

  echo "</div></div>";
  echo "</td></tr></table></div>";
}
?>

<div id='confirmDelete' class='popup'>
  <h2>Confirm Deletion of Assignment</h2><hr>
  <div id='confirmmessage'></div>
  <form action='?controller=assignment&action=delete' method ='post'>
    <input type='hidden' name='classID' value='<?php echo $classID; ?>'>
    <input type='hidden' name='assignmentID' value='0'>
    <input class='standard' type ='submit' value='Delete'>
    <button class='exit standard' type='button'>Cancel</button>
  </form>
</div>

<div id='editClass' class ='popup'>
  <h2>TEST</h2>
  <button class='exit standard' type='button'>Cancel</button>
</div>
