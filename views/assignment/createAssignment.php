
<script src="/Haggis_summer_2017/java/viewSwitch.js"></script>


<h2>Create an Assignment</h2><hr>

<form action='?controller=assignment&action=createAssignment' method='post'>


<div class='creationcontainer'>
    <div class='assignmentCreationGroup'>
      <input class='standard' type='radio' name='makegroup' value='false' checked>Single
      <input class='standard' type='radio' name='makegroup' value='true'>Group
      <div id='groupcreator'><?php require_once('views/group/createGroup.php');?></div>
      <div id ='singleassignment'><?php require_once('views/user/classUser.php');?></div>
    </div>

    <div class='assignmentcreationcontainer'>
      <div class='assignmentCreationHead'>
        <input class='standard' type='hidden' name='classid' value='<?php echo $class->id; ?>'>
        <input class='standard' type='text' name='title' placeholder='New Assignment' required>
        <input class='standard' name='createnew' type='submit' value='Publish'>
      </div>

      <div class='assignmentCreation'>
        critiques given between peers on this assignment should be:<br>
        <input type='radio' name='accountability' value='private'>anonymous
        <input type='radio' name='accountability' value='public' checked>public<br>
        Prompt:<br>
        <textarea class='standard' name='assignmentdescription' cols='100' rows='10' placeholder="Assignment's Description" required></textarea><br>
        Due Date:<input class='standard' type='date' name='duedate' required><br>
        Due Time:<input class='standard' type='time' name='duetime' required><br>
      </div>
      <div class='assignmentCreationCriteria'>
        <br><br>
        <?php echo $criteriaList; ?>
        <?php require_once('views/criteria/createCriteria.php'); ?>
      </div>
    </div>
  </div>
</form>
<?php echo $criteriaStorage; ?>
