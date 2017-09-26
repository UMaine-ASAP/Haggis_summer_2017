<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="java/draganddrop.js"></script>
<script src="java/groupCreator.js"></script>
<h2>Create A Group</h2><hr>
<div id='output'></div>
<div><?php if(isset($message)) echo $message; ?></div>
<table class='grouping'>
  <tr>
    <td colspan='2' class='creationForm'>
      <form action='?controller=group&action=create' method='post'>
        <div  id="output"></div>
        <input class='standard' type='submit' onclick="extractor('group','output')"  value='Create Groups'>
      </form>
      <button type='button' class='standard' onclick='groupFormer()'>Make groups</button>
      <input type='number' class='standard' value =<?php echo $NumofGroups;?> name='numofGroups'>
    </td>
  </tr>
  <tr >
    <td class='studentList' ondrop='drop(event)' ondragover='allowDrop(event)'><?php
      $size = sizeof($userList);
      $maxPerRow = 4;
      $current = 0;
      foreach($userList as $user)
      {
        echo "<button class='standard namebutton' id = '".$user->id."' draggable='true' onclick ='addToBatch(event)' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</button>";
        $current++;
        if($current>$maxPerRow)
        {
          $current=0;
        }
      }

    ?></td>
    <td id='groupmakercontainer'><div id='groupMaker' class='groupMaker' ondrop='drop(event)' ondragover='allowDrop(event)'><span>drag names here to make a group</span></div></td>
  </tr>
</table>
