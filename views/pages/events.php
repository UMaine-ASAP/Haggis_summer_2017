<script src="java/currentActionfixer.js"></script>
<script src="java/HotJumper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
if($status=='admin')
{
  ?>
  <script>fixer("#currentAction",
          "<?php echo $event->title; ?>",
          "<a class='popupmaker' id='eventOptions'>Options</a>");</script>
<?php
}
else
{
  ?>
  <script>fixer("#currentAction",
          "<?php echo $event->title; ?>",
          "");</script>

<?php
}

echo "<table><tr><td class='menuContainer'>";

require_once('views/project/viewEventProjectList.php');
echo "</td>";

// echo "<td class='studentContainer'><div id='studentviewer'>";
// require_once('views/user/classUser.php');
// echo "</div></td>";
echo "<td class='contentContainer'><div id='viewer'>";


echo "</div></td></tr></table>";
if($status=='admin')
  require_once("views/event/eventOptions.php");
?>
