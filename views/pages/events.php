<script src="js/currentActionfixer.js"></script>
<script src="js/HotJumper.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
$eventStatus;
  if($event->active == '1')
    $eventStatus = "<h4 style='color:green;'>Active</h4>";
  else
    $eventStatus = "<h4 style='color:red;'>Inactive</h4>";

if($status=='admin')
{
  ?>
  <script>fixer("#currentAction",
          "<?php echo $event->title; ?>",
          "<a class='popupmaker' id='eventOptions'><input class='standard' type='button' value='Options'></a> <?php echo $eventStatus; ?>");</script>
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
