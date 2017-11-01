<script src="/Haggis_summer_2017/java/assignmentViewer.js"></script>
<?php
  echo "<div class='assignment' id='id".$a->id."'>
  <table>
    <tr>
      <td colspan='2'>
      <h2>".$a->title."</h2>
      <a class = 'prompt' id='".$a->id."'>Prompt</a> <a class='givecritique' id='".$a->id."'>Give Critique</a>";
      // if($status === 'admin')
      // {
      //   echo "
      //   <form action ='?controller=assignment&action=editAssignment' method ='post'>
      //   <button class='standard' value= '".$a->id."' name='assignmentid' type='submit'>Edit Assignment</button>
      //   </form>
      //   <button class='standard' id='delete' name='".$a->id."' type='button'>Delete Assignment</button>";
      // }
  echo "</td></tr><tr><td>";
  ////////////////////////////////////////////////////// PROJECT LISTING
  $projects = $a->projects;
  $ps = sizeof($projects);
  if($projects != null && $ps > 0)
  {
    $test = $projects[0];
    if($test->isgroup === '0')
    {
      echo "students (".$ps.")<hr><ul>";
    }
    else
    {
      echo "groups (".$ps.")<hr><ul>";
    }
    foreach($projects as $p)
    {
      echo "<li><a targetname='".$p->title."'class='projectitem' id='".$p->id."'href='#'>".$p->title."</a></li>";
    }
    echo "</ul>";

  }
    ////////////////////////////////////////////////////// CLASS DETAILS
    echo "</td><td>
    <div class='details' id='".$a->id."'>
    Due Date:".$a->duedate."<br>
    <h3>Prompt</h3>
    ".$a->description."<br>";

    foreach($a->criterias as $c)
    {

      echo "<div><h3>".$c->title."</h3> on scale of ".$c->minRange." to ".$c->maxRange."<br>".$c->description."</div>";
    }
      ////////////////////////////////////////////////////// EVALUATE
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
