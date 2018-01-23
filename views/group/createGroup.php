<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/draganddrop.js"></script>
<div><?php if(isset($message)) echo $message; ?></div>
<table class='grouping'>
  <tr>
    <td colspan='2' class='creationForm'>

        <div  id="output"></div>
        <!-- <input class='standard' type='button' onclick="extractor('group','output')"  value='Create Groups'> -->
      </form>

      Choose the number of groups: <input type='number' class='standard' value =<?php echo $NumofGroups;?> name='numofGroups'><br>
      <button type='button' class='standard' onclick='groupFormer("group","output")'>Generate groups</button>
    </td>
  </tr>
  <tr >
    <td class='studentList' ondrop='drop(event,"group","output")' ondragover='allowDrop(event)'>
      <?php
      $size = sizeof($userList);
      $maxPerRow = 4;
      $current = 0;
      foreach($userList as $user)
      {
        echo "<button type='button' class='standard namebutton' targetuser='$user->id' id = 'u".$user->id."' draggable='true'  onclick ='addToBatch(event)' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</button>";
        $current++;
        if($current>$maxPerRow)
        {
          $current=0;
        }
      }

    ?></td>
    <td id='groupmakercontainer'><div id='groupMaker' class='groupMaker' ondrop='drop(event,"group","output")' ondragover='allowDrop(event)'><span>drag names here to make a group</span></div></td>
  </tr>
</table>
