

<?php
foreach($assignments as $a)
{
  echo "<div class='assignment' id='id".$a->id."'>
  <button id='edit ".$a->id."' type='button'>Edit Assignment</button>
  <button id='delete' name='".$a->id."' type='button'>Delete Assignment</button>
  <h2>".$a->title."</h2><hr>
  Prompt: ".$a->description."<hr>
  This assignment will be graded on the following criteria:<br><br>";
  foreach($a->criterias as $c)
  {
    echo "<strong>".$c->title."</strong> on scale of ".$c->minRange." to ".$c->maxRange."<br>".$c->description."<br>";

  }
  echo "</div>";
}
?>

<div id='confirmDelete' class='popup'>
  <h2>Confirm Deletion of Assignment</h2><hr>
  <form action='?controller=assignment&action=delete' method ='post'>
    <input type='hidden' name='classID' value='<?php echo $classID; ?>'>
    <input type='hidden' name='assignmentID' value='0'>
    <input type ='submit' value='Confirm Deletion'>
    <button type='button' class='exit'>Cancel</button>
  </form>
  </div>
