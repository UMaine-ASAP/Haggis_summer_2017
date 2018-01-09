<script src="js/evaluationmanager.js"></script>

<h3>Evaluate</h3>

<?php
echo "</div>
      <div class='evaluate' id='".$targetid."'>
        <form id='evalform' method='post' action='' isMobile='false'>
        <input type='hidden' name = 'evalfor' class='evalfor' id='".$targetid."' value='".$projectid."'>
        <input type='hidden' name = 'type' value='".$type."'>";

        foreach($criterias as $c)
        {
          if($c->ratingMin === $c->ratingMax)
          {
            echo "<div><h3>".$c->title."</h3><br>".$c->description."<br>";
            echo "<div class='criteriaMsg error'></div>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden' value='-1'>";
            echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'></textarea>";
            echo "</div><hr class='minor'>";
          }
          else
          {
            echo "<div><h3>".$c->title."</h3>";
            echo "<div class='criteriaMsg error'></div>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<div class='criteriaSelectionContainer'>";
            $cellwidth = 100/sizeof($c->criterias);
            foreach($c->criterias as $subc)
            {
              echo "<div onclick='makeselection(this)' class='s".$c->id." picker' id='picker' scoreTarget = '".$c->id."'scoreVal='".$subc->ratingValue."' style='width:".$cellwidth."%'>
                      ".$subc->ratingValue." points
                      <br>".$subc->description."</div>";
            }
            echo "</div>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden'  value='-2'>";
            if($c->allowTextResponse === '1')
              echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:' style='width:100%'></textarea>";
            echo "</div><hr class='minor'>";
          }
        }
        echo "<input class='standard evalsubmit' id='evalsubmit' type='button' value='Submit Evaluation' >
  </form></div></td></tr></table></div>";
?>

<div id='evalout'><h3>Thank you, your feedback has been submitted<h3></div>
