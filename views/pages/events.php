<script src="java/currentActionfixer.js"></script>
<script src="java/HotJumper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>fixer("#currentAction",
        "<?php echo $event->title; ?>","");</script>
<?php

echo "<table><tr><td class='menuContainer'>";

 require_once('views/project/viewEventProjectList.php');
echo "</td>";

// echo "<td class='studentContainer'><div id='studentviewer'>";
// require_once('views/user/classUser.php');
// echo "</div></td>";

echo "<td class='contentContainer'><div id='viewer'>";
// require_once('views/assignment/viewAssignments.php');
echo "</td></tr></table>";

?>
