<h3 class="currentPage">
Projects
</h3>
<table>
<?php
  $projects = Project::assignment($_GET['assignmentID'])[1];
  foreach($projects as $a)
  {
    echo "<tr><td class='assignmentTitle push'>".$a->title."</td></tr>";
    echo "<tr><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=responses&id=".$a->id."'>See Responses</a> ";
    echo "<a class='projectsButton' href='?controller=mobile&action=evaluate&assignmentID=".$_GET['assignmentID']."&projectID=".$a->id."'>Evaluate</a></td></tr>";
  }
?>
