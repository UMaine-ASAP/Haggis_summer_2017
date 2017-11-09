<h3 class="currentPage">
Projects
</h3>
<table  class="marginTable">
<?php
  $projects = Project::assignment($_GET['assignmentID'])[1];
  foreach($projects as $a)
  {
    echo "<tr><td class='assignmentTitle push'>".$a->title."</td></tr>";
    echo "<tr><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&id=".$a->id."'>Responses</a>";
    echo "<tr><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&assignmentID=".$_GET['assignmentID']."&projectID=".$a->id."'>Critique</a></td></tr>";
  }
?>
