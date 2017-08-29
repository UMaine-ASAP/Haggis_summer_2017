<script src="java/currentActionfixer.js"></script>
<script src="java/assignmentViewer.js"></script>
<script>fixer("#currentAction",  "<?php echo $class->coursecode; ?>","<?php if($status ==='admin')echo "Join Code: <div class='joincode'>".$class->joinCode."</div>"; ?>");</script>
<?php
echo "<table><tr><td class='menuContainer'>";
?>
<div class='menutitle'>
  <form method='post' action='?controller=class&action=archiveClass'><input type='hidden' name='classID' value='<?php echo $class->id; ?>'<input type='submit' value='Archive Class'></form>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
  <?php if($status === 'admin'){
     ?>
<div>
  <a class ='newAssignment' href='#'>New Assignment +</a>
</div>
<?php
}
?>
<br>
<div>
  <input class='joinedInputSmaller' type='text' name='searchString' placeholder='search'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-search"></i></button>
</div>
<br>
<ul>
<?php
foreach($assignments as $a)
{
  echo "<li id='".$a->id."'><a href='#'>".$a->title."</a></li>";
}
echo "</ul>";
?>



<?php
echo "</td><td class='contentContainer'>";
echo "<div id='viewer'>";
echo $message;
require_once('views/class/viewClasses.php');

echo "<div class='assignmentcreator'>";
 require_once('views/assignment/createAssignment.php');
 echo "</div>";

echo "</div>";
echo "</td></tr></table>";

?>
