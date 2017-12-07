


<script src="java/livesearch.js"></script>
<div class='menutitle'>
Projects(<?php echo sizeof($projectList);?>)
</div>
<br>
<div>
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString").value, "projects", "orange")' type='text' id='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<ul id="projectlist">
<?php
foreach($projectList as $p)
{
  echo "<li class='projects' onclick='ViewEventProject(".$p->id.",".$event->id.")' id=''>".$p->title."</li>";
}
echo "</ul>";
//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
