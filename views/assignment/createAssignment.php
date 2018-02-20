
<script src="js/draganddrop.js"></script>
<script src="js/viewSwitch.js"></script>
<script src="js/assignmentCreationManager.js"></script>



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
          <!-- <h4>Recreate from a previous assignment?</h4>
          Yes <input type='radio' name='copyAssignment'   value='yes'>
          No  <input type='radio' name='copyAssignment' value='no' checked> -->
          <h4>Assignment Title</h4>
          <input class='standard' oninput='updateTarget(event, "assignmentName")' type='text' name='title' placeholder='New Assignment' required><br>
          <h4>Prompt:</h4>
          <textarea  oninput='updateTarget(event, "promptOut")' name='assignmentdescription' cols='70' rows='20' placeholder="Assignment's Description" required></textarea><br>
          <div class='sidebyside'>
            <div class='sidebysidesub'>
              <h4>Due Date:</h4>
              <input oninput='updateTarget(event, "dueDateOut")' class='standard' type='date' name='duedate' required>
            </div>
            <div class='sidebysidesub'>
              <h4>Due Time:</h4>
              <input oninput='updateTarget(event, "dueTimeOut")' class='standard' type='time' name='duetime' required>
            </div>
            <div class='sidebysidesub'>
              <h4>Choose the assignment Type</h4>
              <input type='radio' name='assignmenttype' onclick='changeType(event, "typeChoice")' value='submissionAssignment' checked>Submission Based<br>
              <input type='radio' name='assignmenttype' onclick='changeType(event, "typeChoice")' value='peerEval'>Peer Evaluation
            <input type='hidden' id='typeChoice' value='true' name='submissionAssignment'>
          </div>
          </div>

        <!-- critiques given between peers on this assignment should be:<br> -->
        <!-- <input type='radio' name='accountability' value='private'>anonymous
        <input type='radio' name='accountability' value='public' checked>public<br> -->
        <input type='hidden' name='accountability' value='private'>

        </div>
        <div class='help' >
          <h2> Step 1 - Basic Information</h2>
          <p>In this section we will focus on the basic information</p>
          <ul>
            <li><p><strong>Title</strong>: This will be how your students will identify the assignement</p></li>
            <li><p><strong>Prompt</strong>: Describe the assignment's details, deliverables, and expectations</p></li>
            <li><p><strong>Due Date</strong>: This is the day that the Assignment is due.</p></li>
            <li><p><strong>Due Time</strong>: This is the time the Assignment is due.</p></li>
            <li><p><strong>Assignment Type</strong></p></li>
            <ul>
              <li><strong>Submission Based</strong>: Assignments that require some form of submission</li>
              <li><strong>Peer Evaluation</strong>: Creates a peer evaluation based assignment</li>
            </ul>
          </ul>

        </div>
        <div class='flowcontrol'>
          <div class='flowcontrolbuttons'>
            <button class='standard largebutton' type='button' onclick='tocriteria()'>Next</button>
          </div>
        </div>
      </div>


      <!-- step 2 -->
      <div id='assignmentCreationCriteria' class='assignmentCreationCriteria'>
        <div class='creation'>
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
        <div class='help'>
          <h2>Step 2 - Rubric Creation</h2>
          <p>In this step, we will create the rubric that will be used to evaluate the projects created for this assignment</p>
          <ul>
            <li><p><strong>1</strong>. First select the scoring range. This will define how many points are awarded per selection</p></li>
            <li><p><strong>2</strong>. Add Criteria</p></li>
            <ul>
              <li><p>Cards are generated below the rubric view.</p></li>
              <li><p>Fill in the Criteria's name</p></li>
              <li><p>Below each criteria are text boxes for you to define what represents that criteria's point level's description</p></li>
            </ul>
            <li><p><strong>3</strong>. Use the Rubric View to ensure information is entered correctly</p></li>
          </ul>

        </div>
        <div class='flowcontrol'>
          <div class='flowcontrolbuttons'>
            <button class='standard largebutton' type='button' onclick='toassignment()' id="reviewAssignment">Next</button>
            <button class='standard largebutton' type='button' onclick='tostart()'>Back</button>
          </div>
        </div>
      </div>

      <!-- step 3 -->
      <div class='assignmentCreationGroup'>
        <div class='creation'>
          <div class='error'id="warningMessage"></div>
          <span id='makegroupfalsespan'><input class='standard' id='makegroupFalse' type='radio' name='makegroup' value='false' checked>Single</span>
          <span id='makegrouptruespan'><input class='standard' id='makegroupTrue' type='radio' name='makegroup' value='true'>Group</span>
          <div id='groupcreator'><?php require_once('views/group/createGroup.php');?></div>
          <div id ='singleassignment'><?php require_once('views/user/classUser.php');?></div>
        </div>
        <div class='help'>
          <h2>Step 3 - Assign To Students</h2>
          <p>In this step we will assign students to work on this assignment</p>
          <ul>
            <li><strong>Single</strong>: Students work on this project alone</li>
            <ul>
              <li>Check the box next to each name to assign student</li>
              <li><strong>Selection Options</strong></li>
              <ul>
                <li><strong>All</strong>: Selects all students</li>
                <li><strong>None</strong>: Deselects all students</li>
                <li><strong>Invert</strong>: Inverts selection</li>
              </ul>
            </ul>
            <li><strong>Group</strong>: Students work together on this assignment</li>
            <ul>
              <li><strong>Auto Group Creation</strong></li>
              <ul>
                <li>In the text box next to the button 'Make groups', enter the number of groups to be generated</li>
                <li>Click 'Make groups' button. The system will randomly assign students to the groups</li>
              </ul>
              <li><strong>Manual Group Creation</strong></li>
              <ul>
                <li>Each name can be dragged to a spot</li>
                <li>Drag the name to the dash lined container to create a new group</li>
                <li>Drag the name to an existing group to add that person to the group</li>
                <li>Names can be dragged out of groups back into the origional container</li>
                <li>Single clicking a name selects it. Select multiple names and drag them to a container to move an entire batch at a time</li>
              </ul>
            </ul>
          </ul>

        </div>
        <div class='flowcontrol'>
          <div class='flowcontrolbuttons'>
            <button class='standard largebutton' type='button' onclick='toreview()'>Next</button>
            <button class='standard largebutton' type='button' onclick='tocriteria()'>Back</button>
          </div>
        </div>
      </div>

      <!-- step 4 -->
      <div id='assignmentCreationReview'>
        <div class='creation'>
          <div>
            <h4> Assign Now?</h4>
            No<input type='radio' name='active' value='no' checked>  Yes<input type='radio' name='active' value='yes'>
          </div>
          <h4>Assignment Name:</h4>
          <div class ='assignmentName'></div>
          <h4>Prompt:</h4>
          <div class ='promptOut'></div>
          <h4>Due Date:</h4>
          <div class ='dueDateOut'></div>
          <h4>Due Time:</h4>
          <div class ='dueTimeOut'></div>
          <h4>Rubric:</h4>
          <div id='rubricviewer'></div>
        </div>

        <div class='help'>
          <h2>Step 4 - Review and Publish</h2>
          <p>Review the entries created from Steps 1 and 2.</p>
          <p>Any entries that you find are in error, return to that step to make the correction</p>
          <p>If all elements are to your satisfaction, click the 'Publish' button.</p>
          <p>Assigned students will recieve a notification e-mail letting them know the assignment is ready</p>
        </div>
        <div class='flowcontrol'>
          <div class='flowcontrolbuttons'>
            <input class='standard largebutton' name='createnew' type='submit' value='Publish'>
            <button class='standard largebutton' type='button' onclick='toassignment()'>Back</button>
          </div>
        </div>
      </div>

  </div>

</form>
<?php echo $criteriaStorage; ?>
