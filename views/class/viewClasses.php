

<?php
foreach($assignments as $a)
{
  echo "<div class='assignment' id='id".$a->id."'>";
  echo "<h2>".$a->title."</h2><hr>";
  echo "Prompt: ".$a->description."<hr>";
  echo "This assignment will be graded on the following criteria:<br><br>";
  foreach($a->criterias as $c)
  {
    echo "<strong>".$c->title."</strong> on scale of ".$c->minRange." to ".$c->maxRange."<br>"; 
    echo $c->description."<br>";

  }
  echo "</div>";
}
?>

<div id='confirmDelete'><div>
