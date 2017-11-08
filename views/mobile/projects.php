Projects:
<br></br>

<?php

  $projects = Project::assignment($_GET['assignmentID'])[1];
  foreach($projects as $a)
  {
    echo "<a href='?controller=mobile&action=evaluate&assignmentID=".$_GET['assignmentID']."&projectID=".$a->id."'>".$a->title."</a><br>";
  }
?>
