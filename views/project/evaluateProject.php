<h2>Evaluate Project</h2>

<?php
echo "</div>
      <div class='evaluate' id='".$a->id."'>
        <form method='post' action='?controller=evaluate&action=submit'>
        <input type='hidden' name = 'evalfor' class='evalfor' id='".$a->id."' value='0'>
        <h2 class='targetproject' id='".$a->id."'>Choose a project to evaluate</h2>";
        foreach($a->criterias as $c)
        {
          echo "<div><h3>".$c->title."</h3> on scale of ".$c->minRange." to ".$c->maxRange."<br>".$c->description."<br>";
          echo "<input class='standard' name='criteriaID[]' type='hidden' value='".$c->id."'>";
          echo "<input class='standard criteriaRatingout' name ='x' id='".$c->id."'></output><br>";
          echo "<input class='standard criteriaRating' name='criteriaRateing[]' id='".$c->id."' type='range' max='".$c->maxRange."' min='".$c->minRange."'>";
          echo "<input class='standard' name='criteriaComment[]' type='text' placeholder='Comment:'>";
          echo "</div><hr>";
        }
        echo "<input class='standard' type=submit value='Submit Evaluation'>
  </form></div></td></tr></table></div>";
?>
