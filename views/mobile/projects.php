<div class='titlespan'>
<div class='bbcontainer'>
  <a href=<?php
    if($type == '1') {
      echo "index.php?controller=mobile&action=assignments&classID=".$classID;
    } else {
      echo "index.php?controller=mobile&action=events";
    }

    ?> class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Projects</h3>
  </div>
</div>




<?php
  if ($type == '1') {
    foreach($projects as $a)
    {
      echo "<div class='projectsCard' id='$a->id'>";
      echo "<h3>".$a->title."</h3><hr><div class='buttoncontainer'>";
      if($assignment->privacy == '0' || $isadmin)
        echo "<a  href='?controller=mobile&action=responses&classID=".$classID."&assignmentID=".$assignmentID."&id=".$a->id."'><button class='buttonLink'>View Responses</button></a>";
      echo "<a  href='?controller=mobile&action=evaluate&classID=".$classID."&assignmentID=".$assignmentID."&projectID=".$a->id."'><button class='buttonLink'>Give Critique</button></a></div></div>";
    }
  } else {
    foreach($eventprojectList as $a)
    {
      echo "<div class='projectsCard id='$a->id'>";
      echo "<h3>$a->title</h3><hr><br>";
      echo "<a  href='?controller=mobile&action=evaluate&eventID=".$eventID."&projectID=".$a->id."'><button class='buttonLink'>Critique</button></a></div>";
    }
  }
?>


<script src="js/toggleTab.js"></script>
