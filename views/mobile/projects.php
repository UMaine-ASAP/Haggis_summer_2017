<h3 class="currentPage">
Projects
</h3>
<table  class="marginTable">
<?php
  foreach($projects as $a)
  {
    echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
    echo "<tr class='".$a->id."'><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&assignmentID=".$assignmentID."&id=".$a->id."'>Responses</a>";
    echo "<tr class='".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&assignmentID=".$_GET['assignmentID']."&projectID=".$a->id."'>Critique</a></td></tr>";
  }
?>
</table>

<script src="java/toggleTab.js"></script>
