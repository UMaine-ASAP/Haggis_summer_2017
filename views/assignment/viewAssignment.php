
<?php
  echo "<div class='assignment' id='id".$a->id."'>
  <table>
  <tr><td colspan='2'>";
  if($type ==='submission')
    echo "<h2>Assignment: ".$a->title."</h2>";
  else
    echo "<h2>Evaluation: ".$a->title."</h2>";
  echo "<span><button class='standard promptlink' onclick='GetPrompt(".$a->id.")'>Prompt</button></span>";
  if($status === 'admin')
  {
    if($type ==='submission')
      echo "<button class='standard popupmaker' id='addToEvent'>Add To Event</button>";
    echo "<button class='standard popupmaker' id='deleteAssignment'>Delete Assignment</button><br>";
    if($type ==='submission')
      echo "<span>Project registration link:
        <a title='Share this link so non registered users can submit their project' class='registrationlink' href='http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerAssignment&target=".$a->id."'>
          http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerAssignment&target=".$a->id."</a></span>";

  }

    echo "<hr></td></tr>
    <tr>
      </td></tr><tr><td class='ProjectList' style='text-align:center'>";
  ////////////////////////////////////////////////////// PROJECT LISTING
  $projects = $a->projects;
  $ps = sizeof($projects);
  $groups;
  if($projects != null && $ps > 0)
  {
    $sample = $projects[0];
    $test = $sample->isgroup;
    echo "projects (".$ps.")<hr class='minor'>";
    foreach($projects as $p)
    {
      echo "<div><button onclick='GetAssignmentProject(";

      echo $p->id.',"'.$type.'"';

      echo ")' class='standard projectitem' id='".$p->id."'>".$p->title."</button>";
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
