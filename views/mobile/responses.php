<h3 class="currentPage">
  <a class="backButton" href=<?php echo "index.php?controller=mobile&action=projects&classID=".$classID."&assignmentID=".$assignmentID; ?>><i class="glyphicons glyphicons-arrow-left">Back</a>
  Project Responses
</h3>
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
    // echo "<div  class='push'>"
    echo "<h3 class='push'>".$n."</h3>";
    if($cAvg[$i] > 0)
      echo "Average Rating: ".$cAvg[$i]."<br>";
    foreach($cComments[$i] as $c)
    {
      echo "<div class='rcomment'>".$c."</div>";
    }
    echo "<br>";
    $i++;
  }
  // echo "</div>"
}
?>
