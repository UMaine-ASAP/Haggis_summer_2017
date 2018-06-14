<script src='js/projectAnalyticsBarGraph.js'></script>
<style type="text/css">

.bar{
	fill: steelblue;
}

.bar:hover{
	fill: blue;
}

.criteriaButton {
	position: relative;
	float: left;
	height: 10%;
	width: 15%;
}

.axis path,
.axis line {
  fill: none;
  stroke: black;
  stroke-width: 2px;
  shape-rendering: crispEdges;
}

#toolTip {
	position: absolute;
	display: none;
	min-width: 80px;
	height: auto;
	background: none repeat scroll 0 0 #ffffff;
	border: 3px solid darkblue;
	padding: 14px;
	text-align: center;
	z-index: 3;
	border-radius: 5px;
}

svg#svgBarGraph {
	width: 100%;
	height: 110%;
	float: left;
	position: absolute;
	margin-top: 5%;
	margin-bottom: 0%;
}

svg text.label {
  fill:white;
  font: 15px;  
  font-weight: 400;
  text-anchor: middle;
}

.svgXAxis {
	position: fixed;
	bottom: 0%;
	width: 110%;
	height: 3%;
	background-color: white;
}

.projectcontainer {
	overflow: visible;
}

#sortBars {
	position: relative;
}

</style>
<?php
	if ($type == "submission")
	{
		foreach ($criteriaSetList as $key => $criteria)
		{
			echo "<button class='standard criteriaButton' type='button' onclick='switchCriteriaAverageGroup(".$criteria->id.", \"$criteria->title\", \"$userType\")'>".$criteria->title." Averaged Ratings</button><br>";
		}
	}
	else
	{
		foreach ($criteriaSetList as $key => $criteria)
		{
			echo "<button class='standard criteriaButton' type='button' onclick='switchCriteriaAveragePeer(".$criteria->id.", \"$criteria->title\", \"$userType\")'>".$criteria->title." Averaged Ratings</button><br>";
		}
	}
?>