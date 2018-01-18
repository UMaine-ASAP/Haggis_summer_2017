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
            echo "<br><br><input type='range' class='slider standard' name='criteriaRating[]' id='".$c->id."' min='".$c->ratingMin."' max='".$c->ratingMax."' value='".$c->ratingMin."'>";
            echo "</div>";
            if($c->allowTextResponse === '1')
              echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:' style='width:100%'></textarea>";
            echo "</div><hr class='minor'>";
          }
        }
        echo "<input class='standard evalsubmit' id='evalsubmit' type='button' value='Submit Evaluation' >
  </form></div></td></tr></table></div>";
?>

<div id='evalout'><h3>Due to an error, your evaluation was not submitted. <h3></div>
