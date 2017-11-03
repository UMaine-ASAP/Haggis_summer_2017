<h3>Project Responses</h3>

<?php
$i=0;
if(sizeof($cNames)<1)
  echo "No Evaluations yet, Be the first!";
else
{
  foreach($cNames as $n)
  {
    echo "<h3>".$n."</h3>";
    echo "Average Rating: ".$cAvg[$i]."<br>";
    foreach($cComments[$i] as $c)
    {
      echo $c."<br>";
    }
    echo "<br>";
    $i++;
  }
}
?>
