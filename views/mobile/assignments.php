
<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php?controller=mobile&action=classes" class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Assignments(<?php echo sizeof($assignments);?>)</h3>
  </div>
</div>


<br>
<table class="marginTable">
<?php
foreach($assignments as $a)
{
  echo "<tr><td><hr class='dropDown'><td><tr>";
  echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
  echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$a->id."'>Projects</a></td></tr>";
}
  echo "</ul>";
  echo "<tr><td><hr class='dropDown'><td><tr>";

?>
</table>

<script src="js/toggleTab.js"></script>
