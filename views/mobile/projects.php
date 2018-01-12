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



<!--<a href="index.php" class="backButton"><span class="glyphicons glyphicons-arrow-left"></span></a>-->
<table  class="marginTable">
<?php
  if ($type == '1') {
    foreach($projects as $a)
    {
      echo "<tr><td><hr class='dropDown'><td><tr>";
      echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
      echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&classID=".$classID."&assignmentID=".$assignmentID."&id=".$a->id."'>Responses</a>";
      echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&classID=".$classID."&assignmentID=".$assignmentID."&projectID=".$a->id."'>Critique</a></td></tr>";
    }
  } else {
    foreach($eventprojectList as $a)
    {
      echo "<tr><td><hr class='dropDown'><td><tr>";
      echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
      //echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&classID=".$classID."&assignmentID=".$assignmentID."&id=".$a->id."'>Responses</a>";
      echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&eventID=".$eventID."&projectID=".$a->id."'>Critique</a></td></tr>";
    }
  }
  echo "<tr><td><hr class='dropDown'><td><tr>";
?>
</table>

<script src="js/toggleTab.js"></script>
