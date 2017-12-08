<script src="java/evaluationmanager.js"></script>

<h3>Evaluate</h3>

<?php
echo "</div>
      <div class='evaluate' id='".$targetid."'>
        <form id='evalform' method='post' action=''>
        <input type='hidden' name = 'evalfor' class='evalfor' id='".$targetid."' value='".$projectid."'>
        <input type='hidden' name = 'type' value='".$type."'>";

        foreach($criterias as $c)
        {
          if($c->minRange === $c->maxRange)
          {
            echo "<div><h3>".$c->title."</h3><br>".$c->description."<br>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden' value='0'>";
            echo "<textarea rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
            echo "</div><hr class='minor'>";
          }
          else
          {
            echo "<div><h3>".$c->title."</h3> on scale of ".$c->minRange." to ".$c->maxRange."<br>".$c->description."<br>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input disabled class='standard criteriaRatingout' name ='x' id='".$c->id."' value='".((int)$c->maxRange/2)."'><br>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='range' max='".$c->maxRange."' min='".$c->minRange."' value='".((int)$c->maxRange/2)."'>";
            if($c->allowTextResponse === '1')
              echo "<textarea rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
            echo "</div><hr class='minor'>";
          }
        }
        echo "<input class='standard' id='evalsubmit' type='button' value='Submit Evaluation'>
  </form></div></td></tr></table></div>";
?>

<div id='evalout'><h3>Thank you, your feedback has been submitted<h3></div>
