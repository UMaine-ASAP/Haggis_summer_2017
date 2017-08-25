<script src="java/currentActionfixer.js"></script>
<script src="java/assignmentViewer.js"></script>
<script>fixer("#currentAction",  "<?php echo $class->coursecode; ?>","<?php echo "Join Code: <div class='joincode'>".$class->joinCode."</div>"; ?>");</script>
<?php
echo "<table><tr><td class='menuContainer'>";
?>
<div class='menutitle'>
  <?php foreach($_SESSION['message'] as $m) echo $m; ?>
Assignments(<?php echo sizeof($assignments);?>)
</div>
<br>
<div>
  <a class ='newAssignment' href='#'>New Assignment +</a>
</div>
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

foreach($assignments as $a)
{
  echo "<div class='assignment' id='id".$a->id."'>";
  echo "<h2>".$a->title."</h2><hr>";
  echo "Prompt: ".$a->description;
  echo "</div>";
}

echo "<div class='assignmentcreator'>";
 require_once('views/assignment/createAssignment.php');
 echo "</div>";

echo "</div>";
echo "</td></tr></table>";

?>
