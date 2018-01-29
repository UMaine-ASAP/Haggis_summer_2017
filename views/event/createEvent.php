<script src='js/formScaler.js'></script>

<h2>Event Creation</h2>


<form action='?controller=event&action=add' method='post'>
<div class='eventcreationcontainer'>
  <div class='eventcreationbasics'>
    <h4>Basic Information</h4>

    <input class='standard' type='text' name='title' required><br>
    <textarea class='standard' rows='5' cols='50' name='description' required></textarea><br>
    Start Time <input class='standard' type='time' name='startTime' required>
    End Time   <input class='standard' type='time' name='endTime' required><br>
    Start Date <input class='standard' type='date' name='startDate' required>
    End Date   <input class='standard' type='date' name='endDate' required><br>
    Make this event Active now?<br>
    No <input class='standard' type='radio' name='active' value='0'>
    Yes <input class='standard' type='radio' name='active' value='1'><br>
    <input type='submit' class='standard eventsubmit' value='create this event'>


  </div>



  <div class='eventCreationCritera'>
    <h4>Rubric Creation</h4>
    <?php echo $criteriaList; ?>
    <div class='chooseCriteria'>
      <h4>Copy Rubric from a previous assignment</h4>
      <input type='hidden' id="copyRubric" name='copyRubric' value='false'>
      <input type='hidden' id="copyRubricID" name ='copyRubricID' value='0'>
      Yes <input type='radio' name='choosecopy' onclick="showTargetHideOther(event, 'criteraCopyManager', 'criteriaCreationManager')" value='true'>
      No  <input type='radio' name='choosecopy' onclick="showTargetHideOther(event, 'criteriaCreationManager', 'criteraCopyManager')" value='false' checked>
    </div>
    <hr>
    <div id='criteriaCreationManager'>
      <?php echo $criteriaList; ?>
      <?php require_once('views/criteria/createCriteria.php'); ?>
    </div>
    <div id='criteraCopyManager'>
      <?php require_once('views/criteria/copyCriteria.php'); ?>
    </div>
  </div>

</div>
<br>


</form>
