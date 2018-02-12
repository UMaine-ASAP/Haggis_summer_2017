


<script src="js/livesearch.js"></script>
<div class='menutitle'>
Projects(<?php echo sizeof($projectList);?>)
</div>
<br>
<div>
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString").value, "projects", "orange")' type='text' id='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<div class='projectList'>
<ul id="projectlist">
<?php
foreach($projectList as $p)
{
  echo "<li class='projects' onclick='ViewAssignmentProject(".$p->id.",".$event->id.")' id=''>".$p->title."</li>";
  // if($p->isgroup ==='1') echo "<ul><li>group</li></ul>";
}
echo "</ul>";
//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
</div>
