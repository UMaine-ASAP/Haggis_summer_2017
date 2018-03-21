
<?php
  echo "<div class='assignment' id='id".$a->id."'>";
  if($type ==='submission')
    echo "<h2>Assignment: ".$a->title."</h2>";
  else
    echo "<h2>Evaluation: ".$a->title."</h2>";
  echo "<span><button class='standard promptlink' type='button' onclick='GetPrompt(".$a->id.",\"$type\")'>Prompt</button></span>";
  if($status === 'admin')
  {

    if($a->assigned == '1')
      echo "<button class='standard popupmaker' onclick='createPopup(\"setActive\")' id='setActive'>Assignment is Active</button>";
    else
      echo "<button class='standard popupmaker' onclick='createPopup(\"setActive\")' id='setActive'>Assignment is Inactive</button>";
    if($a->privacy == '1')
      echo "<button class='standard popupmaker' onclick='createPopup(\"setPrivacy\")' id='setPrivacy'>Privacy is Active</button>";
    else
      echo "<button class='standard popupmaker' onclick='createPopup(\"setPrivacy\")' id='setPrivacy'>Privacy is Inactive</button>";


    echo "<button class='standard popupmaker' onclick='createPopup(\"deleteAssignment\")' id='deleteAssignment'>Delete Assignment</button><br>";
  }
  echo "<hr></div><br>";
  echo "<div class='projectcontainer'>";
  echo "<div class='ProjectList' id='ProjectList' style='text-align:center'>";
  ////////////////////////////////////////////////////// PROJECT LISTING
  require_once("views/project/viewPeers.php");

  echo "</div><div id='ProjectView'>";
  $_SESSION['targetid'] = $a->id;
  require_once("views/assignment/detailsAssignment.php");
  echo "</div></div>";
?>

<div class="popup" id="addToEvent"><?php require_once('views/event/addToEvent.php');?></div>
<div class="popup" id="deleteAssignment"><?php require_once('views/assignment/deleteAssignment.php');?></div>
<div class="popup" id="setActive"><?php require_once("views/assignment/setStatus.php");?></div>
<div class="popup" id="setPrivacy"><?php require_once("views/assignment/setPrivacy.php");?></div>
