<script src='java/formScaler.js'></script>
<div class='exit'>
  <i class="glyphicon glyphicon-remove"></i>
</div>
<h2>Event Mode</h2>
<hr class='minor'>

By activating event mode, this will allow anyone using Haggis to review the current assignment you have selected.
<br><br>
<form>
  <input type="text" name="projectname" placeholder="Project Name"><br>
  <textarea cols='75' rows='5' placeholder='Short Description'></textarea><br>
  <textarea cols='75' rows='5' placeholder='Abstract'></textarea><br>
  <input type="text" name='principleInvestigator' placeholder='Principle Investigator'><br>
  <input type='number' min='1' id='numOfMembers' name ='numOfMembers' value ='1'><br>
  <div id='membercount'>
    <input type ="text" name=firstName[] placeholder='FirstName'><input type="text" name='middleInitial[]' max='1' placeholder='M'><input type="text" name='lastname[]' placeholder='Last Name'><input type='email' name='email[]' placeholder='Email Address'>
  </div>
  <input type='text' name='projectCode' placeholder='Project Code'><br>
  <input type="radio" name="visibility" value='true' checked>Visibile &nbsp;&nbsp;
  <input type="radio" name="visibility" value='false'> Anonymous<br>
  <button class='standard'>begin the event</button>
</form>
