<h3>
Assignments (<?php echo sizeof($assignments);?>)
</h3>
<br>
<table>
<?php
foreach($assignments as $a)
{
  echo "<tr><th>".$a->title."</th></tr>";
  echo "<tr><td><a href='?controller=mobile&action=projects&assignmentID=".$a->id."'>Projects</a></td></tr>";
}
echo "</ul>";
?>
</table>
