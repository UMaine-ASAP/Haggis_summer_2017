<script src="java/livesearch.js"></script>
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
  // Needs URL, controller function,and page to view people's projects
  echo "<a class='assignments' href=''>".$a->title."</a><br>";
}
echo "</ul>";
?>
