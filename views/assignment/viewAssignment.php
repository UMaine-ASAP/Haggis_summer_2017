
<?php
  echo "<div class='assignment' id='id".$a->id."'>
  <table>
  <tr><td colspan='2'><span><button class='standard promptlink' onclick='GetPrompt(".$a->id.")'>Prompt</button></span>";
  if($status === 'admin')
  {
    echo "<button class='standard popupmaker' id='addToEvent'>Add To Event</button>";
    echo "<button class='standard popupmaker' id='deleteAssignment'>Delete Assignment</button><br>";
    echo "<span>Project registration link:
        <a class='registrationlink' href='http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerAssignment&target=".$a->id."'>
          http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerAssignment&target=".$a->id."</a></span>";

  }

    echo "</td></tr>
    <tr>
      <td colspan='2' style='text-align:center'>
      <h2>".$a->title."</h2>";
      if($status === 'admin')
      {

        // <form action ='?controller=assignment&action=editAssignment' method ='post'>
        // <button class='standard' value= '".$a->id."' name='assignmentid' type='submit'>Edit Assignment</button>
        // </form>
        // <button class='standard' id='delete' name='".$a->id."' type='button'>Delete Assignment</button>";
      }
  echo "</td></tr><tr><td class='ProjectList' style='text-align:center'>";
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
      echo "students (".$ps.")<hr class='minor'>";
    }
    else
    {
      echo "groups (".$ps.")<hr class='minor'>";
    }
    foreach($projects as $p)
    {
      echo "<div><button onclick='GetAssignmentProject(".$p->id.")' class='standard projectitem' id='".$p->id."'>".$p->title."</button>";
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
    echo "</div>";
  }
  echo "</td><td id=ProjectView>";
  $_SESSION['targetid'] = $a->id;
  require_once("views/assignment/detailsAssignment.php");
  echo "</td></tr></table>";
?>

<div class="popup" id="addToEvent"><?php require_once('views/event/addToEvent.php');?></div>
<div class="popup" id="deleteAssignment"><?php require_once('views/assignment/deleteAssignment.php');?></div>
