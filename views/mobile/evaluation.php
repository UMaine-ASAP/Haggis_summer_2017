<script src='js/evaluationmanager.js'></script>
<?php
$linkout;
  if ($type == "1") {
    $linkout = "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID;
  } else {
    $linkout = "index.php?controller=mobile&action=projects&eventID=".$eventID;
  }
  ?>
<div class='titlespan'>
<div class='bbcontainer'>
  <a href=<?php echo $linkout;?> class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Critique</h3>
  </div>
</div>




<form class='evalform' id='evalform' method='post' action='' isMobile='true'>
  <input type='hidden' name = 'type' value='<?php echo $type; ?>'>

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
  foreach($criteria as $c)
  {
    // Needs URL, controller function,and page to view people's projects
    if($c->ratingMin === $c->ratingMax)
    {
      echo "<div><h3>".$c->title."</h3><br>".$c->description."<br>";
      echo "<div class='criteriaMsg error'></div>";
      echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
      echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden' value='-1'>";
      echo "<textarea rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
      echo "</div><hr class='minor'>";
    }
    else
    {
      echo "<div><h3>".$c->title."</h3>";
      echo "<div class='criteriaMsg error'></div>";
      echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
      $hide= false;
      echo "<div class='criteriaSelectionContainer'>";
      foreach($c->criterias as $subc)
      {
        echo "<div class='s".$c->id." picker' id='s".$c->id."' scoreTarget='".$c->id."' scoreVal='".$subc->ratingValue."'";
        if($hide)
          echo " style='display:none'";

        echo ">".$subc->ratingValue." points<br>".$subc->description."</div>";
        $hide = true;
      }
      echo "<div><input type='range' class='slider' name='criteriaRating[]' id='".$c->id."' min='".$c->ratingMin."' max='".$c->ratingMax."' value='".$c->ratingMin."'></div>";
      echo "</div>";
      if($c->allowTextResponse === '1')
        echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:' style='width:100%'></textarea>";
      echo "</div><hr class='minor'>";
      echo "<div class='error' id='masterError'></div>";
    }
  }

  echo "<br><input class='submitButton evalsubmit' type='button' value='Submit Evaluation'>";
  echo "</form></div></td></tr></table></div>";
?>
