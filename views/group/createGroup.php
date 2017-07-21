<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="java/draganddrop2.js"></script> -->
<script src="java/formScaler.js"></script>
<script>
$(function() {
  $(".draggable").draggable({ snap: ".groupbox"});
});
</script>




<h2>Create A Group</h2>
<div>Number of groups: <input id="numOfGroups" type="number" value="2" min="2" name="numOfGroups">
  <form action='?controller=group&action=create' method='post'>
    <div  id="output"></div>
    <input type='submit' onclick="extractor('groupbox','output')" value='Create Groups'>
  </form>
</div>
<div>
  <?php
    $size = sizeof($userList);
    $maxPerColumn = 4;
    $current = 0;
    foreach($userList as $user)
    {
      echo "<button class='draggable' draggable style='border:1px solid red' id = '".$user->id."'>".$user->firstName." ".$user->lastName."</button>";
      // $current++;
      // if($current>$maxPerColumn)
      // {
      //   echo "</td><td>";
      //   $current=0;
      // }
    }
  ?>
</div>

<table>
  <tr id="groupboxes">
    <td class ='groupbox' id ="group" style="border:2px solid black">
      Group 1
    </td>
    <td class ='groupbox' id ="group" style="border:2px solid black">
      Group 2
    </td>
  </tr>
</table>



<?php if(isset($_POST['labels']))
      {
        foreach($_POST['labels'] as $lable)
        {
          echo "<br>";
          foreach($_POST[$lable] as $element)
          echo $element." ";
        }
      }
      ?>
