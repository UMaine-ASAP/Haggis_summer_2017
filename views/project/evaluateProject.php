<script src="js/evaluationmanager2.js"></script>

<h3>Evaluate</h3>

<?php
echo "</div>
      <div class='evaluate' id='".$targetid."'>
        <form id='evalform' method='post' action='' isMobile='false'>
        <input type='hidden' name = 'evalfor' class='evalfor' id='".$targetid."' value='".$projectid."'>
        <input type='hidden' name = 'type' value='".$type."'>";

        foreach($criterias as $c)
        {
          $content ="";
          $rating = 1;

          if($returner)
          foreach($critiques as $pc)
          {
            if($pc->criteriaID == $c->id)
            {
              $content = $pc->comment;
              $rating = $pc->rating;
            }
          }

          if($c->ratingMin === $c->ratingMax)
          {

            echo "<div><h3>".$c->title."</h3><br>".$c->description."<br>";
            echo "<div class='criteriaMsg error'></div>";
            echo "<input class='standard criteriaID' name='criteriaID[]' type='hidden' value='".$c->id."'>";
            echo "<input class='criteriaRating' name='criteriaRating[]' id='".$c->id."' type='hidden' value='-1'>";
            echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:'>$content</textarea>";
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
            echo "<br><br><input type='range' class='slider standard' name='criteriaRating[]' id='".$c->id."' min='".$c->ratingMin."' max='".$c->ratingMax."' value='".$rating."'>";
            echo "</div>";
            if($c->allowTextResponse === '1')
              if($type == 2)
                echo "<input required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='hidden' value=' '>$content</textarea>";
              else
                echo "<textarea required rows='5' cols='75' class='standard criteriaComment' name='criteriaComment[]' type='text' placeholder='Comment:' style='width:100%'>$content</textarea>";

            echo "</div><hr class='minor'>";
          }
        }
        echo "<div class='error' id='masterError'></div>";
        echo "<input class='standard evalsubmit' id='evalsubmit' type='button' value='Submit Evaluation' >
  </form></div></td></tr></table></div>";
?>

<div id='evalout'><h3>Submitting Critique...<h3></div>

  <script>

  $('.slider').each(function()
{
    var thiselement = $(this);
    var criID = thiselement.attr("id");

    var criScore = thiselement.val();
    var criteriaOutputs = document.getElementsByClassName('s'+criID);
    for(var i = 0; i < criteriaOutputs.length; i++)
    {
      var currCri = criteriaOutputs[i];

      if(currCri.getAttribute("scoreVal") == criScore)
      {
        currCri.setAttribute('style', "display:block");
      }
      else
      {
        currCri.setAttribute('style', "display:none");
      }
    }
  });


  </script>
