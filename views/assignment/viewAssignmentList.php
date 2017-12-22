<script src="java/livesearch.js"></script>
<?php
if($status === 'admin')
echo "<a id='NewAssignment' onclick='NewAssignment(".$classID.")'><button type='button' class='standard mediumbutton'>New Assignment +</button></a>";
?>
<div class='menutitle'>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<div>
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString").value, "assignments", "orange")' type='text' id='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<ul id="assignmentList">
<?php
foreach($assignments as $a)
{
  echo "<li class='assignments' onclick='ViewAssignment(".$a->id.",".$classID.")' id=''>".$a->title."</li>";
}
echo "</ul>";
//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
