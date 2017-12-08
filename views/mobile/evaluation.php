<script src='java/evaluationmanager.js'></script>

<div class='titlespan'>
<div class='bbcontainer'>
  <a href=<?php
    if ($type == "1") {
      echo "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID;
    } else {
      echo "index.php?controller=mobile&action=projects&eventID=".$eventID;
    }
    ?> class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Critique</h3>
  </div>
</div>


<table  class="marginTable">
<form id='evalform' method='post' action='?controller=evaluate&action=submit&quick=1&mobile=1'>

<!-- <?php
  // if ($type == '1'){
    // echo "?controller=mobile&action=evaluate&classID=".$classID."&assignmentID=".$assignmentID."&projectID=".$projectID;
  // } else {
    // echo "?controller=mobile&action=eventSubmit&eventID=".$eventID;
//  }
  ?>> -->
<input type='hidden' name = 'evalfor' class='evalfor' value="<?php echo $projectID; ?>">
<hr>
<?php
  foreach($criteria as $a)
  {
    // Needs URL, controller function,and page to view people's projects
    if($a->minRange === $a->maxRange)
    {
      echo "<div><tr><td class='criteriaTitle push'>".$a->title."</tr></td>";
      echo "<tr><td class='push'><span>".$a->description."</span><br></tr></td>";
      echo "<tr><td><input class='criteriaID' name='criteriaID[]' type='hidden' value='".$a->id."'></tr></td>";
      echo "<tr><td><input name='type' type='hidden' value='".$type."'></tr></td>";
      echo "<tr><input class='criteriaRating slider' name='criteriaRating[]' id='".$a->id."' type='hidden' value='-1'></div></tr></td>"; //slider
      echo "<tr><td class='adjustTop center commentBot'><textarea class='commentBox' name='criteriaComment[]' type='text' placeholder='Comments...' required></textarea></tr></td>";
    }
    else
    {
      echo "<div><tr><td class='criteriaTitle push'>".$a->title."</tr></td>";
      echo "<tr><td class='push'><span>On a scale of ".$a->minRange." to ".$a->maxRange."</span><br></tr></td>";
      echo "<tr><td class='push'><span>".$a->description."</span><br></tr></td>";
      echo "<tr><td><input class='criteriaID' name='criteriaID[]' type='hidden' value='".$a->id."'></tr></td>";
      echo "<tr><td><input name='type' type='hidden' value='".$type."'></tr></td>";
      echo "<tr><td class='adjustTop push'><input class='criteriaRatingout' name='x' id='".$a->id."' value='".((int)$a->maxRange/2)."'></tr></td>";  //number
      echo "<tr><td class='adjustTop'><div id='sliderWidth'><input class='criteriaRating slider' name='criteriaRating[]' id='".$a->id."' type='range' min='".$a->minRange."' max='".$a->maxRange."'></div></tr></td>"; //slider
      if ($a->allowTextResponse) {
        echo "<tr><td class='adjustTop center commentBot'><textarea class='commentBox' name='criteriaComment[]' type='text' placeholder='Comments...' required></textarea></tr></td>";
      }
    }
    echo "<tr><td><hr><td><tr>";
    echo "</div>";
  }


?>
<tr><td class="submitButton"><br><input class="submitButton" type='Submit' value='Submit'></tr></td>
</form>
