<script src='java/formScaler.js'></script>
<h2>Project Registration</h2>

Please submit your registration for <?php echo $assignment->title;?>

<script src='java/formScaler.js'></script>
<form action='?controller=project&action=register' method='post' id='projreg'>
  <input class='standard' type='hidden' name='targetid' value='<?php echo $assignment->id;?>'>
  <input class='standard' type="text" name="projectname" placeholder="Project Name"><br>
  <textarea class='standard' cols='75' rows='5' name='projectdesc' placeholder='Short Description'></textarea><br>
  <!-- <textarea class='standard' cols='75' rows='5' name='abst' placeholder='Abstract'></textarea><br> -->
  <!-- <input class='standard' type="text" name='principleInvestigator' placeholder='Principle Investigator'><br> -->
  <!-- <input class='standard' type='number' min='1' id='numOfMembers' name ='numOfMembers' value ='1'><br> -->
  <div id='membercount'>
    <input class='standard' type ='text' name=firstName[] placeholder='FirstName'><input class='standard' type='text' name='middleInitial[]' max='1' placeholder='M'><input class='standard' type='text' name='lastname[]' placeholder='Last Name'><input class='standard' type='email' name='email[]' placeholder='Email Address'>
  </div>
  <!-- <input class='standard' type='text' name='projectCode' placeholder='Project Code'><br> -->

  <input class='standard' type="submit" value="Submit Project">
</form>
