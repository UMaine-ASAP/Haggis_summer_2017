<script src="java/currentActionfixer.js"></script>
<script src="java/rangereport.js"></script>
<script src="java/HotJumper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>fixer("#currentAction",
        "<?php echo $class->coursecode; ?>",
        "<?php if($status ==='admin')
          echo "<div>(".sizeof($students)." students)</div>";
          echo "<p>Join Code: <joincode>".$class->joinCode."</joincode></p>"; ?>");</script>
<?php

echo "<table><tr><td class='menuContainer'>";
 if($status === 'admin')
echo "<a id='NewAssignment' onclick='NewAssignment(".$classID.")'>New Assignment +</a>";
require_once('views/assignment/viewAssignmentList.php');
echo "</td>";

// echo "<td class='studentContainer'><div id='studentviewer'>";
// require_once('views/user/classUser.php');
// echo "</div></td>";

echo "<td class='contentContainer'><div id='viewer'>";
echo $message;
require_once('views/assignment/viewAssignments.php');
echo "</td></tr></table>"

?>
