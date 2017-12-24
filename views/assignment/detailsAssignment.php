<h2> Assignment Details</h2>

<?php
////////////////////////////////////////////////////// CLASS DETAILS
echo "<div class='details' id='".$a->id."'>
Due Date:".$a->duedate."<br>
<h3>Prompt</h3>
".$a->description."<br>";
$ratingValues = array();

$c = $a->criterias[0];
foreach($c->criterias as $subc)         //Collect the values as the column headers
  $ratingValues[] = $subc->ratingValue;

//Start constructing the table to hold the rubric
$rubricForm =  "<div><table>
                <tr>
                <th>Criteria</th>";


for($i = 0; $i< sizeof($ratingValues);$i++)
  $rubricForm .= "<th>".$ratingValues[$i]."</th>";

$rubricForm .= "</tr>";

foreach($a->criterias as $c)
{
  $rubricForm .= "<tr><td>".$c->title."</td>";
  foreach($c->criterias as $subc)
  {
    $rubricForm .= "<td>".$subc->description."</td>";
  }

}
$rubricForm .= "</tr></table></div>";

echo $rubricForm;

?>
