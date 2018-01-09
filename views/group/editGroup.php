<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/draganddrop.js"></script>
<script src="js/formScaler.js"></script>

<h2>Edit Groups</h2>


<div><?php if(isset($message)) echo $message; ?></div>



<?php  if(isset($groups)) { ?>
    <table>
      <tr>
        <td>
          Number of groups: <input id="numOfGroups" type="number" value="<?php echo sizeof($groups);?>" min="2" name="numOfGroups">
        </td>
        <td>
          <form action='?controller=group&action=create' method='post'>
            <input type ='hidden' name='finalstep' value ="true">
            <div  id="output"></div>
            <input type='submit' onclick="extractor('groupbox','output')"  value='Create Groups'>
          </form>
        </td>
      </tr>
      <tr >
        <td ondrop='drop(event)' ondragover='allowDrop(event)'>
          Container
        </td>
      </tr>
      <tr id="groupboxes">

        <?php
        $counter = 1;
        foreach($groups as $group)
        {
          echo  "<td class='groupbox' id ='".$group->studentGroupID."'  ondrop='drop(event)' ondragover='allowDrop(event)'> Group ".$counter;
          foreach($group->users as $user)
          {
            echo "<button class='namebutton' id = '".$user->id."' draggable='true' onclick ='addToBatch(event)' ondragstart='drag(event)'>".$user->firstName." ".$user->lastName."</button>";
          }
          echo "</td>";
          $counter += 1;
        }
        ?>
      </tr>
    </table>

<?php
  }

  else
  {
    ?>

    <form action='?controller=group&action=edit' method='post'>
    <select name='projectID'>
      <?php
      foreach($projectIDs as $id)
        echo "<option value='".$id."'>".$id."</option>";
      ?>
    </select>
    <input type='submit' value='Submit'>
    </form>

    <?php
  }
?>
