<script src="java/criteriaCreationManager.js"></script>
<script src="java/viewSwitch.js"></script>
<script src="java/assignmentCreationManager.js"></script>


<h2>Create an Assignment</h2>

<table class='taskholder'>
  <tr>
    <td class='task' id='step1' onclick='tostart()'>Step 1: Basic Information</td>
    <td class='task' id='step2' onclick='tocriteria()'>Step 2: Create a Rubric</td>
    <td class='task' id='step3' onclick='toassignment()'>Step 3: Assign to Students</td>
    <td class='task' id='step4' onclick='toreview()'>Step 4: Review and Publish</td>
  </tr>
</table>

<form action='?controller=assignment&action=createAssignment' method='post'>
<div class='creationcontainer'>

      <!-- step 1 -->
      <div class='assignmentCreation'>
        <div class='creation'>
          <input class='standard' type='hidden' name='classid' value='<?php echo $class->id; ?>'>
          <h4>Assignment Title</h4>
          <input class='standard' oninput='updateName(event)' type='text' name='title' placeholder='New Assignment' required><br>
          <h4>Prompt:</h4>
          <textarea class='standard' name='assignmentdescription' cols='70' rows='20' placeholder="Assignment's Description" required></textarea><br>
          <div class='sidebyside'><div><h4>Due Date:</h4><input class='standard' type='date' name='duedate' required></div>
        <div><h4>Due Time:</h4><input class='standard' type='time' name='duetime' required></div></div>
        critiques given between peers on this assignment should be:<br>
        <input type='radio' name='accountability' value='private'>anonymous
        <input type='radio' name='accountability' value='public' checked>public<br>

        </div>
        <div class='help' >
          <h2> Step 1 - Basic Information</h2>
          <p>In this section we will focus on the basic information</p>
          <p class='aName'>Give your assignment a name. This will be how your students will identify the assignement</p>

          <div class='flowcontrol'>
            <button class='standard largebutton' type='button' onclick='tocriteria()'>Next <i class="glyphicon glyphicons-arrow-right"></i></button>
          </div>
        </div>
      </div>


      <!-- step 2 -->
      <div id='assignmentCreationCriteria' class='assignmentCreationCriteria'>
        <div class='creation'>
          <?php echo $criteriaList; ?>
          <?php require_once('views/criteria/createCriteria.php'); ?>
        </div>
        <div class='help'>
          <h2>Step 2 - Rubric Creation</h2>
          First choose the scoring range you wish your criteria to take.
          This represents the points each rubric item can be scored at.

          The table to the left will populate itself as a quick overiview of the work you complete using the cards below.
          Press the plus sign to add another criteria

          Use the cards to edit each criteria and a description of each of its point values
          <div class='flowcontrol'>
            <button class='standard largebutton' type='button' onclick='toassignment()' id="reviewAssignment">Next</button>
            <button class='standard largebutton' type='button' onclick='tostart()'><i class="glyphicon glyphicons-arrow-left"></i>Back</button>
          </div>
        </div>
      </div>

      <!-- step 3 -->
      <div class='assignmentCreationGroup'>
        <div class='creation'>
          <input class='standard' type='radio' name='makegroup' value='false' checked>Single
          <input class='standard' type='radio' name='makegroup' value='true'>Group
          <div id='groupcreator'><?php require_once('views/group/createGroup.php');?></div>
          <div id ='singleassignment'><?php require_once('views/user/classUser.php');?></div>
        </div>
        <div class='help'>
          <h2>Step 3 - Assign To Students</h2>
          <div class='flowcontrol'>
            <button class='standard largebutton' type='button' onclick='toreview()'>Next <i class="glyphicon glyphicons-arrow-right"></i></button>
            <button class='standard largebutton' type='button' onclick='tocriteria()'><i class="glyphicon glyphicons-arrow-left"></i> Back</button>
          </div>
        </div>
      </div>

      <!-- step 4 -->
      <div id='assignmentCreationReview'>
        <div class='creation'>
          <div id='rubricviewer'>
          </div>
        </div>

        <div class='help'>
          <h2>Step 4 - Review and Publish</h2>

          <div class='flowcontrol'>
            <button class='standard largebutton' name='createnew' type='submit'>Publish</button>
            <button class='standard largebutton' type='button' onclick='toassignment()'><i class="glyphicon glyphicons-arrow-left"></i>Back</button>
          </div>
        </div>

      </div>

  </div>

</form>
<?php echo $criteriaStorage; ?>
