<script src='java/evaluationmanager.js'></script>

<h3 class="currentPage">
  <a class="backButton" href=<?php echo "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID; ?>>&lt;- Back</a>
  Critique
</h3>
<table  class="marginTable">
<form id='evalform' method='post' action='?controller=mobile&action=evaluate'>
<input type='hidden' name = 'evalfor' class='evalfor' value="<?php echo $projectid; ?>">
<hr>
<?php
  foreach($criteria as $a)
  {
    // Needs URL, controller function,and page to view people's projects
    echo "<div><tr><td class='criteriaTitle push'>".$a->title."</tr></td>";
    echo "<tr><td class='push'><span>On a scale of ".$a->minRange." to ".$a->maxRange."</span><br></tr></td>";
    echo "<tr><td class='push'><span>".$a->description."</span><br></tr></td>";
    echo "<tr><td><input class='criteriaID' name='criteriaID[]' type='hidden' value='".$a->id."'></tr></td>";
    echo "<tr><td class='adjustTop push'><input class='criteriaRatingout' name='x' id='".$a->id."' value='".((int)$a->maxRange/2)."'></tr></td>";  //number
    echo "<tr><td class='adjustTop'><div id='sliderWidth'><input class='criteriaRating slider' name='criteriaRating[]' id='".$a->id."' type='range' min='".$a->minRange."' max='".$a->maxRange."'></div></tr></td>"; //slider
    if ($a->allowTextResponse) {
      echo "<tr><td class='adjustTop center commentBot'><textarea class='commentBox' name='criteriaComment[]' type='text' placeholder='Comments...' required></textarea></tr></td>";
    }
    echo "<tr><td><hr><td><tr>";
    echo "</div>";
  }


?>
<tr><td class="submitButton"><br><input class="submitButton" type='Submit' value='Submit'></tr></td>
</form>
<div id="evalout"></div>
