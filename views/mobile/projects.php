Projects:
<br></br>

<?php

  $projects = Project::assignment($_GET['assignmentID'])[1];
  foreach($projects as $a)
  {
    // Needs URL, controller function,and page to view people's projects
    echo "<a href='?controller=mobile&action=evaluate&projectID=".
          $a->id."'>".
          $a->title."</a><br>";
  }
?>
