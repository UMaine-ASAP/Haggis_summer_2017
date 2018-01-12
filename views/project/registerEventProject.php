<!-- <script src='js/formScaler.js'></script> -->
<div class='projectRegistration'>
  <h2>Project Registration</h2>

  Please submit your registration for <?php echo $e->title;?>

  <form action='?controller=project&action=registerEvent' method='post' id='projreg'>
    <input type='hidden' name='targetid' value='<?php echo $e->id;?>'>
    <div class="inputProjectRegistration"><input class='standard typeBox' type="text" name="projectname" placeholder="Project Name" required autofocus></div>
    <div class="inputProjectRegistration"><textarea class='standard typeBoxBig' cols='75' rows='5' name='projectdesc' placeholder='Short Description' required></textarea></div>
    <!-- <textarea class='standard' cols='75' rows='5' name='abst' placeholder='Abstract'></textarea><br> -->
    <!-- <input class='standard' type="text" name='principleInvestigator' placeholder='Principle Investigator'><br> -->
    <!-- <input class='standard' type='number' min='1' id='numOfMembers' name ='numOfMembers' value ='1'><br> -->
    <div id='membercount'>
      <div class="inputProjectRegistration"><input class='standard typeBox' type ='text' name=firstName[] placeholder='FirstName' required></div>
      <div class="inputProjectRegistration"><input class='standard typeBox' type='text' name='middleInitial[]' max='1' placeholder='Middle Inital' ></div>
      <div class="inputProjectRegistration"><input class='standard typeBox' type='text' name='lastname[]' placeholder='Last Name' required></div>
      <div class="inputProjectRegistration"><input class='standard typeBox' type='email' name='email[]' placeholder='Email Address' ></div>
    </div>
    <!-- <input class='standard' type='text' name='projectCode' placeholder='Project Code'><br> -->

    <input class='standard bigButton' type="submit" value="Submit Project">
  </form>
</div>
