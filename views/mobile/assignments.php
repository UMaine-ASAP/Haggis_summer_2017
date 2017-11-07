<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<ul id="assignmentList">
<?php
foreach($assignments as $a)
{
  // Needs URL, controller function,and page to view people's projects
  echo "<a class='assignments' href='?controller=mobile&action=projects&assignmentID=".$a->id."'>".$a->title."</a><br>";
}
echo "</ul>";
?>
