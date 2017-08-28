<?php
foreach($assignments as $a)
{
  echo "<div class='assignment' id='id".$a->id."'>";
  echo "<button type='button'>Edit Class</button>";
  echo "<h2>".$a->title."</h2><hr>";
  echo "Prompt: ".$a->description."<hr>";
  echo "This assignment will be graded on the following criteria:<br><br>";
  foreach($a->criterias as $c)
  {
    echo $c->title.": ".$c->description."<br>";
    echo "Scale: ".$c->minRange." to ".$c->maxRange."<br><br>";
  }
  echo "</div>";
}
?>

<div id='confirmDelete'><div>
