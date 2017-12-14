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
if($status == 'admin')
{
  echo "<td class='contentContainer'><div id='viewer'>";
  echo "<span>Project registration link: <a class='registrationlink' href='http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerEvent&target=".$event->id."'>http://".getenv('HTTP_HOST')."/Haggis_summer_2017/?controller=project&action=registerEvent&target=".$event->id."</a><br>";

  if($event->active)
    echo "<a href='?controller=event&action=setActive&eventid=".$event->id."&status=0'>Set Event inactive</a>";
  else
    echo "<a href='?controller=event&action=setActive&eventid=".$event->id."&status=1'>Set Event active</a>";
// require_once('views/assignment/viewAssignments.php');
}
echo "</td></tr></table>";

?>
