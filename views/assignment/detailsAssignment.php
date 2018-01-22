
<?php
if($type ==='submission')
  echo "<h2>Assignment Details</h2>";
else
  echo "<h2>Peer Evaluation Details</h2>";
////////////////////////////////////////////////////// CLASS DETAILS
echo "<div class='details' id='".$a->id."'>
Due Date:".$a->duedate."<br>
<h3>Prompt</h3>
".nl2br($a->description)."<br>";
$ratingValues = array();

$rubric = $a->rubric;
$c = $rubric->criteriaSets;
$subc = $c[0]->criterias;

for($i = 0; $i<sizeof($subc);$i++)
{
  $ratingValues[] = $subc[$i]->ratingValue;
}



//Start constructing the table to hold the rubric
$rubricForm =  "<div><table>
                <tr>
                <th>Criteria</th>";


for($i = 0; $i< sizeof($ratingValues);$i++)
  $rubricForm .= "<th>".$ratingValues[$i]."</th>";

$rubricForm .= "</tr>";


foreach($rubric->criteriaSets as $c)
{
  $rubricForm .= "<tr><td class='criDesc'>".$c->title."</td>";
  foreach($c->criterias as $subc)
  {
    $rubricForm .= "<td class='criDesc'>".$subc->description."</td>";
  }

}
$rubricForm .= "</tr></table></div>";

echo $rubricForm;

?>
