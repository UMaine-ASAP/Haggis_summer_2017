<script src="js/livesearch.js"></script>
<?php
$assignmentListSize = sizeof($assignments);
if($status === 'admin')
echo "<a id='NewAssignment' onclick='NewAssignment(".$classID.")'><button type='button' class='standard mediumbutton'>New Assignment +</button></a>";
?>
<div class='menutitle'>
<h4>Assignments</h4>
</div>
<!-- <br> -->
<!-- <div>
  <input class='joinedInputSmaller' onkeyup='searchNhighlight(document.getElementById("searchString").value, "assignments", "orange")' type='text' id='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div> -->
<!-- <br> -->

<?php
$unassigned = array();
if($assignmentListSize > 0)
{
  foreach($assignments as $a)
  {
    if($a->assigned == '1')
      echo "<div class='assignments' onclick='ViewAssignment(".$a->id.",".$classID.")' id=''><button class='standard' style='list-style-type: none;width:80%'>".$a->title."</button></div>";
    else
      $unassigned[]=$a;
  }
  if($status === 'admin')
  {
    echo "<hr> Inactive Assignments";
    foreach($unassigned as $a)
    {
      echo "<div class='assignments' onclick='ViewAssignment(".$a->id.",".$classID.")' id=''><button class='standard' style='list-style-type: none;width:80%'>".$a->title."</button></div>";
    }
  }
}
else
{
  echo "There are currently no assignments.";
}

//if(isset($_GET['action']) && $_GET['action'] == 'createAssignment')
?>
