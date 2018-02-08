<script src="js/currentActionfixer.js"></script>
<script src="js/HotJumper.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




        <?php
          if($status=='admin')
          {
            ?>
            <script>fixer("#currentAction",
                    "<?php echo $class->coursecode; ?>",
                    "<div><a href='#' id='studentlist' onclick='createPopup(\"studentlist\")'>(<?php echo sizeof($students);?> students)</a></div><p>Join Code: <joincode><?php echo $class->joinCode;?></joincode></p>");</script>
          <?php
          }
          else
          {
            ?>
            <script>fixer("#currentAction","<?php echo $class->coursecode; ?>","");</script>


          <?php
          }


echo "<table><tr><td class='menuContainer'>";
require_once('views/assignment/viewAssignmentList.php');
echo "</td>";

// echo "<td class='studentContainer'><div id='studentviewer'>";
// require_once('views/user/classUser.php');
// echo "</div></td>";

echo "<td class='contentContainer'><div id='viewer'>";
echo $message;
require_once('views/assignment/viewAssignments.php');
echo "</td></tr></table>";

if($status === 'admin')
{
?>
    <div class ='popup' id='studentlist'>
      <div class='exit' onclick='closePopup("studentlist")'><i class="glyphicon glyphicon-remove"></i></div>
      <h2>Class Roster</h2><hr>
      <div class='sidebyside'>
        <div class='sidebysidesub'>
          <h4>Currently Enrolled Students</h4>
    <?php foreach($students as $s)
          {
            echo $s->firstName." ".$s->middleInitial." ".$s->lastName."<br>";
          }
          echo "</div>";
          if($status ==='admin')
          {
            echo "<div class='sidebysidesub'><h4>Enroll Students</h4><form action='?controller=class&action=addToClass' method = 'post'>
                  <input type='hidden' name ='classid' value ='".$classID."'>
                  Select one or more students to be added to this class:<br>
                  <select name ='student[]' size='15' multiple>";
                  foreach($allusers as $u)
                  {
                    echo "<option value='".$u->id."'>".$u->firstName." ".$u->middleInitial." ".$u->lastName."</option>";
                  }
            echo "</select><br><input type='submit' value='Enroll Student(s)'></form></div>";
          }?>
        </div>

    </div>
<?php
}
?>
