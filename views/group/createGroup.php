<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="java/draganddrop.js"></script>
<script src="java/formScaler.js"></script>
<h2>Create A Group</h2>


<table>
  <tr>
    <td>
      Number of groups: <input id="numOfGroups" type="number" value="2" min="2" name="numOfGroups">
    </td>
    <td>
      <form action='?controller=group&action=create' method='post'>
        <div  id="output"></div>
        <input type='submit' onclick="extractor('groupbox','output')" value='Create Groups'>
      </form>
    </td>
  <tr >
    <td>
      <?php
        $size = sizeof($userList);
        $maxPerColumn = 4;
        $current = 0;
        foreach($userList as $user)
        {
          echo "<button style='border:1px solid red' id = '".$user->id."' draggable='true' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</button>";
          // $current++;
          // if($current>$maxPerColumn)
          // {
          //   echo "</td><td>";
          //   $current=0;
          // }
        }
      ?>
    </td>
  </tr>
  <tr id="groupboxes">
    <td class ='groupbox' id = "group" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">
      Group 1
    </td>
    <td class = 'groupbox' id = "group" ondrop="drop(event)" ondragover="allowDrop(event)" style="border:2px solid black">
      Group 2
    </td>
  </tr>
</table>

<?php
  if(isset($message))
  {
    echo $message;
  }
  ?>
