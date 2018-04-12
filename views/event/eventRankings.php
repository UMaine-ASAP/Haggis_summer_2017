<table class='placmenttable'>
  <tr >
    <th colspan="3"><h3>Top 3</h3></th>
  </tr>
  <tr>


<?php
for($i = 0; $i < sizeof($projectRankingStorage); $i++)
{
  echo "<td class='placement'>";
  switch($i)
  {
    case 0:
      echo "<h3>First</h3> ";
      break;
    case 1:
      echo "<h3>Second</h3> ";
      break;
    case 2;
      echo "<h3>Third</h3> ";
      break;
  }
  if($projectRankingStorage[$i] != null)
    echo "<strong>".$projectRankingStorage[$i]->title."</strong><br>Submission Number: ".$projectRankingStorage[$i]->projectEventCode."<br>Score: ".$ranking[$i]."<br>Number of Respones: ".$countRankingStorage[$i];
  else
  {
    echo "Not enough evaluations submitted to poulate this position.";
  }
  echo "</td>";
}

?>
</tr>
</table>


<table class='rankingTable'>


  <?php
  for($i = 0; $i < sizeof($projectTitles); $i++)
  {
    if($projectNumber[$i] != "0")
    {
      $myclass = "celleven";
      if($i%2 == 1)
        $myclass = "cellodd";
      if($i%50 == 0)
      {
        echo "<tr><th class='tabletitle'>Submission Number</th><th class='tabletitle'>Project Title</th><th class='tabletitle'>People's Choice</th><th>Number of Respones</th></tr>";
      }

      echo "<tr><td class='".$myclass."'>".$projectNumber[$i]."</td><td class='".$myclass."'>".$projectTitles[$i]."</td><td class='".$myclass."'>".$projectRankings[$i]."</td><td>".$projectResponseCount[$i]."</td></tr>";
    }
  }
  ?>
</table>
