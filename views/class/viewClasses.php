

<?php
foreach($assignments as $a)
{
  echo "
  <div class='assignment' id='id".$a->id."'>";
  if($status === 'admin')
  {
    echo "<button class = 'standard' id='edit ".$a->id."' type='button'>Edit Assignment</button>
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
  echo "<div id='assignmentcreator'>";
  require_once('views/assignment/createAssignment.php');
  echo "</div>";
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
