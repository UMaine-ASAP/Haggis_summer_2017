<h3><a href=<?php echo "index.php?controller=mobile&action=projects&assignmentID=".$assignmentID; ?>>&lt;- Back</a> Project Responses</h3>
<script type ="text/javascript" src="vendor/Chart.bundle.min.js"></script>
<script type ="text/javascript" src="vendor/jquery.min.js"></script>
<script type ="text/javascript" src="java/bargraph.js"></script>


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
