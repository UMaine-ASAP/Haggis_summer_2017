<h3 class="currentPage">
Assignments (<?php echo sizeof($assignments);?>)
</h3>
<br>
<table class="marginTable">
<?php
foreach($assignments as $a)
{
  echo "<tr><td class='assignmentTitle push'>".$a->title."</td></tr>";
  echo "<tr><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=projects&assignmentID=".$a->id."'>Projects</a></td></tr>";
}
echo "</ul>";
?>
</table>
