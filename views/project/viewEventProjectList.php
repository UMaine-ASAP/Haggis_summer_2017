


<script src="js/livesearch.js"></script>
<div class='menutitle'>
Projects(<?php echo sizeof($projectList)+sizeof($eventprojectList);?>)

</div>
<br>
<div>
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString").value, "projects", "orange")' type='text' id='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>

<?php
foreach($projectList as $p)
{
  if($p->id != '')
    echo "<div class='projects' onclick='ViewEventProject(".$p->id.",".$event->id.",1)' id=''><button class='standard' style='list-style-type: none;width:80%'>".$p->title."</button></div>";
}
foreach($eventprojectList as $p)
{
  if($p->id != '')
    echo "<div class='projects' onclick='ViewEventProject(".$p->id.",".$event->id.",2)' id=''><button class='standard' style='list-style-type: none;width:80%'><strong>".$p->projectEventCode."</strong>-".$p->title."</button></div>";
}

//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
