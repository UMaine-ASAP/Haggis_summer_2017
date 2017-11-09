<script src='java/evaluationmanager.js'></script>

<h3 class="currentPage">Critique</h3>
<table  class="marginTable">
<form id='evalform' mathod='POST' action>
<input type="hidden" name="evalfor" class="evalfor" id="34" value="55">

<?php

  $criteria = Criteria::assignmentID($_GET['assignmentID'])[1];

  foreach($criteria as $a)
  {
    // Needs URL, controller function,and page to view people's projects
    echo "<div><tr><td class='assignmentTitle push'>".$a->title."</tr></td>";
    echo "<tr><td class='push'><span>On a scale of ".$a->minRange." to ".$a->maxRange."</span><br></tr></td>";
    echo "<tr><td class='push'><span>".$a->description."</span><br></tr></td>";
    echo "<tr><td><input class='criteriaID' name='criteriaID[]' type='hidden' value='".$a->id."'></tr></td>";
    echo "<tr><td class='adjustTop push'><input class='criteriaRatingout' name='x' id='".$a->id."' value='".((int)$a->maxRange/2)."'></tr></td>";  //number
    echo "<tr><td class='adjustTop'><div id='sliderWidth'><input class='criteriaRating slider' name='criteriaRating[]' id='".$a->id."' type='range' min='".$a->minRange."' max='".$a->maxRange."'></div></tr></td>"; //slider
    if ($a->allowTextResponse) {
      echo "<tr><td class='adjustTop center'><textarea class='commentBox' name='criteriaComment[]' type='text' placeholder='Comments...' required></textarea></tr></td>";
    }
    echo "</div>";
  }

?>


<tr><td class="projectsButton"><br><input class="submitButton" type='submit' value='Submit'></tr></td>
</form>
<div id="evalout"></div>
