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

<style>
.chart div {
  font: 10px sans-serif;
  background-color: steelblue;
  text-align: right;
  padding: 3px;
  margin: 1px;
  color: white;
}
</style>
<script src="vendor/d3/d3.js"></script>
<script>
var data = [1.5, 3.3, 6, 4.1, 8.9];
d3.select(".chart")
  .selectAll("div")
  .data(data)
    .enter()
    .append("div")
    .style("width", function(d) {return d;})
    .text(function(d){return d;});
    </script>
<div class='chart'></div>
