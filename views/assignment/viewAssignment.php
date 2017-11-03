
<?php
  echo "<div class='assignment' id='id".$a->id."'>
  <table>
  <tr><td></td><td></td></tr>
    <tr>
      <td colspan='2'>
      <h2>".$a->title."</h2>
      <a class='promptlink' onclick='GetPrompt(".$a->id.")'>Prompt</a>";
      // if($status === 'admin')
      // {
      //   echo "
      //   <form action ='?controller=assignment&action=editAssignment' method ='post'>
      //   <button class='standard' value= '".$a->id."' name='assignmentid' type='submit'>Edit Assignment</button>
      //   </form>
      //   <button class='standard' id='delete' name='".$a->id."' type='button'>Delete Assignment</button>";
      // }
  echo "</td></tr><tr><td class='ProjectList'>";
  ////////////////////////////////////////////////////// PROJECT LISTING
  $projects = $a->projects;
  $ps = sizeof($projects);
  if($projects != null && $ps > 0)
  {
    $test = $projects[0];
    if($test->isgroup === '0')
    {
      echo "students (".$ps.")<hr class='minor'><ul>";
    }
    else
    {
      echo "groups (".$ps.")<hr class='minor'><ul>";
    }
    foreach($projects as $p)
    {
      echo "<li><a onclick='GetProject(".$p->id.")' class='projectitem' id='".$p->id."'>".$p->title."</a></li>";
    }
    echo "</ul>";
  }
  echo "</td><td id=ProjectView>";
  $_SESSION['targetid'] = $a->id;
  require_once("../controllers/detailsAssignmentController.php");//?id=".$a->id);
  echo "</td></tr></table>";
?>
