<script src="java/currentActionfixer.js"></script>
<script src="java/assignmentViewer.js"></script>
<script>fixer("#currentAction",  "<?php echo $class->coursecode; ?>","<?php if($status ==='admin')echo "Join Code: <div class='joincode'>".$class->joinCode."</div>"; ?>");</script>
<?php
echo "<table><tr><td class='menuContainer'>";

require_once('views/assignment/viewAssignments.php');
?>



<?php
echo "</td><td class='contentContainer'>";
echo "<div id='viewer'>";
echo $message;
require_once('views/class/viewClasses.php');
echo "</td></tr></table>"

?>
