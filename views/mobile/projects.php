<h3 class="currentPage">
  <a class="backButton" href=<?php
    if($type == '1') {
      echo "index.php?controller=mobile&action=assignments&classID=".$classID;
    } else {
      echo "index.php?controller=mobile&action=events";
    }

    ?>>&lt;- Back</a>
  Projects
</h3>

<!--<a href="index.php" class="backButton"><span class="glyphicons glyphicons-arrow-left"></span></a>-->
<table  class="marginTable">
<?php
  echo "<tr><td><hr class='dropDown'><td><tr>";
  if ($type == '1') {
    foreach($projects as $a)
    {
      echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
      //echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&classID=".$classID."&assignmentID=".$assignmentID."&id=".$a->id."'>Responses</a>";
      echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&classID=".$classID."&assignmentID=".$assignmentID."&projectID=".$a->id."'>Critique</a></td></tr>";
    }
  } else {
    foreach($eventprojectList as $a)
    {
      echo "<tr><td class='assignmentTitle push' onclick='viewTab(".$a->id.")'>".$a->title."</td></tr>";
      //echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='responsesButton' href='?controller=mobile&action=responses&classID=".$classID."&assignmentID=".$assignmentID."&id=".$a->id."'>Responses</a>";
      echo "<tr class='tab ".$a->id."'><td class='projectsButton'><a class='projectsButton' href='?controller=mobile&action=evaluate&classID=".$classID."&assignmentID=".$assignmentID."&projectID=".$a->id."'>Critique</a></td></tr>";
    }
  }
  echo "<tr><td><hr class='dropDown'><td><tr>";
?>
</table>

<script src="java/toggleTab.js"></script>
