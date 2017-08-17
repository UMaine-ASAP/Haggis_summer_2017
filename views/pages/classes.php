<?php
echo $message;
echo "<table><tr><td class='menuContainer'>";

require_once('views/assignment/viewAssignments.php');
echo "</td><td class='contentContainer'>";
$class = Klass::classid($_GET['classID'])[1];
require_once('views/class/viewClass.php');
echo "</td></tr></table>";

?>
