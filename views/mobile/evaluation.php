<script src='java/evaluationmanager.js'></script>

<h3>Evaluate</h3>

<form id='evalform' mathod='POST' action>
<input type="hidden" name="evalfor" class="evalfor" id="34" value="55">

<?php

  $criteria = Criteria::assignmentID($_GET['assignmentID'])[1];

  foreach($criteria as $a)
  {
    // Needs URL, controller function,and page to view people's projects
    echo "<div><h3>".$a->title."</h3>";
    echo "<span>On a scale of ".$a->minRange." to ".$a->maxRange."</span><br>";
    echo "<span>".$a->description."</span><br>";
    echo "<input class='criteriaID' name='criteriaID[]' type='hidden' value='".$a->id."'>";
    echo "<input class='criteriaRatingout' name='x' id='".$a->id."' value='".((int)$a->maxRange/2)."'>";
    echo "<input class='criteriaRating' name='criteriaRating[]' id='".$a->id."' type='range' min='".$a->minRange."' max='".$a->maxRange."'>";
    if ($a->allowTextResponse) {
      echo "<textarea name='criteriaComment[]' type='text' placeholder='Comment:' required></textarea>";
    }
    echo "</div>";
  }

?>


<br><input type='submit' value='Submit Evaluation'>
</form>
<div id="evalout"></div>
