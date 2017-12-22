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
          if($c->ratingMin === $c->ratingMax)
          {
            echo "<div><h3>".$c->title."</h3><br>".$c->description."<br>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden' value='-1'>";
            echo "<textarea rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
            echo "</div><hr class='minor'>";
          }
          else
          {
            echo "<div><h3>".$c->title."</h3> on scale of ".$c->ratingMin." to ".$c->ratingMax."<br>".$c->description."<br>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input disabled class='standard criteriaRatingout' name ='x' id='".$c->id."' value='".((int)$c->ratingMax/2)."'><br>";
            echo "<div><table><tr>";
            foreach($c->criterias as $subc)
            {
              echo "<td>".$subc->description."</td>";
            }
            echo "</tr></table></div>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='range' max='".$c->ratingMax."' min='".$c->ratingMin."' value='".((int)$c->ratingMax/2)."'>";
            if($c->allowTextResponse === '1')
              echo "<textarea rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
            echo "</div><hr class='minor'>";
          }
        }
        echo "<input class='standard' id='evalsubmit' type='button' value='Submit Evaluation'>
  </form></div></td></tr></table></div>";
?>

<div id='evalout'><h3>Thank you, your feedback has been submitted<h3></div>
