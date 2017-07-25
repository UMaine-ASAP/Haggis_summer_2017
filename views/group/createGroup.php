<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="java/draganddrop.js"></script>
<script src="java/formScaler.js"></script>
<h2>Create A Group</h2>

<table>
  <tr>
    <td>
      Number of groups: <input id="numOfGroups" type="number" value="<?php echo $NumofGroups;?>" min="2" name="numOfGroups">
    </td>
    <td>
      <form action='?controller=group&action=create' method='post'>
        <div  id="output"></div>
        <input type='submit' onclick="extractor('groupbox','output')"  value='Create Groups'>
      </form>
    </td>
  </tr>
  <tr >
    <td ondrop='drop(event)' ondragover='allowDrop(event)'>
      <?php
        $size = sizeof($userList);
        $maxPerRow = 4;
        $current = 0;
        foreach($userList as $user)
        {
          echo "<button class='namebutton' id = '".$user->id."' draggable='true' onclick ='addToBatch(event)' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</button>";
          $current++;
          if($current>$maxPerRow)
          {
            echo "<br>";
            $current=0;
          }
        }
      ?>
    </td>
  </tr>
  <tr id="groupboxes">
    <?php
      for($i = 0; $i < $NumofGroups; $i++)
      {
        $curr = $i +1;
        echo "<td class='groupbox' id ='group'  ondrop='drop(event)' ondragover='allowDrop(event)'> Group ".$curr."</td>";
      }
    ?>
  </tr>
</table>

<?php
  if(isset($message))
  {
    echo $message;
  }
  ?>
