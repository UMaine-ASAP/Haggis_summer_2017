<script src="java/popup.js"></script>
<?php
  echo "<div class='assignment' id='id".$a->id."'>
  <table>
  <tr><td></td><td>
  <button class='standard popupmaker' id ='eventMode'>Event mode</button></td></tr>
    <tr>
      <td colspan='2'>
      <h2>".$a->title."</h2>";
      if($status === 'admin')
      {
        echo "<span><a class='promptlink' onclick='GetPrompt(".$a->id.")'>Prompt</a></span><br>
    <span>Project registration link: <a class='registrationlink' href='http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=register&target=".$a->id."'>http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=register&target=".$a->id."</a>";
        // echo "
        // <form action ='?controller=assignment&action=editAssignment' method ='post'>
        // <button class='standard' value= '".$a->id."' name='assignmentid' type='submit'>Edit Assignment</button>
        // </form>
        // <button class='standard' id='delete' name='".$a->id."' type='button'>Delete Assignment</button>";
      }
  echo "</td></tr><tr><td class='ProjectList'>";
  ////////////////////////////////////////////////////// PROJECT LISTING
  $projects = $a->projects;
  $ps = sizeof($projects);
  $groups;
  if($projects != null && $ps > 0)
  {
    $sample = $projects[0];
    $test = $sample->isgroup;
    if($test === '0')
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
      if($p->isgroup ==='1' || $p->isgroup ==='2')
      {
        echo "<ul>";
        $listing = $p->list;
        foreach($listing as $u)
        {
          echo "<li class='assignedname'>".$u->firstName." ".$u->middleInitial." ".$u->lastName."</li>";
        }
        echo "</ul></li>";
      }
    }
    echo "</ul>";
  }
  echo "</td><td id=ProjectView>";
  $_SESSION['targetid'] = $a->id;
  require_once("views/assignment/detailsAssignment.php");//?id=".$a->id);
  echo "</td></tr></table>";
?>

<div class="popup" id="eventMode"><?php require_once('views/event/createEvent.php');?></div>
