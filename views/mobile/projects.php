Projects:
<table>
<?php
  $projects = Project::assignment($_GET['assignmentID'])[1];
  foreach($projects as $a)
  {
    echo "<tr><th>".$a->title."</th></tr>";
    echo "<tr><td><a href='?controller=mobile&action=responses&id=".$a->id."'>See Responses</a> ";
    echo "<a href='?controller=mobile&action=evaluate&assignmentID=".$_GET['assignmentID']."&projectID=".$a->id."'>Evaluate</a></td></tr>";
  }
?>
