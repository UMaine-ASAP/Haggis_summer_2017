<script src="java/currentActionfixer.js"></script>
<script src="java/assignmentViewer.js"></script>
<script>fixer("#currentAction",
        "<?php echo $class->coursecode; ?>",
        "<?php if($status ==='admin')
          echo "<div>(".sizeof($students)." students)</div>";
          echo "<p>Join Code: <joincode>".$class->joinCode."</joincode></p>"; ?>");</script>
<?php

echo "<table><tr><td class='menuContainer'>";
require_once('views/assignment/viewAssignments.php');
echo "</td>";

// echo "<td class='studentContainer'><div id='studentviewer'>";
// require_once('views/user/classUser.php');
// echo "</div></td>";

echo "<td class='contentContainer'><div id='viewer'>";
echo $message;
require_once('views/class/viewClasses.php');
echo "</td></tr></table>"

?>
