<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<ul id="assignmentList">
<?php
foreach($assignments as $a)
{
  echo "<div>".$a->title."<br>";
  // Each "<a>" tag is a button, Evaluate is working, responses will soon
  //echo "<a href=''>See Responses</a>&nbsp;";
  echo "<a href='?controller=mobile&action=projects&assignmentID=".$a->id."'>Projects</a><br>";
  echo "</div>";
}
echo "</ul>";
?>
