<script src="js/userCreation.js"></script>
<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>New User Registration</h2><hr>

<div>
  <form action='?controller=user&action=register' method='post'>
    <input class='standard' type='text' name='firstname' placeholder='First Name' autofocus required>
    <input class='standard' type='text' name='middleinitial' maxlength='1' size = '1' placeholder='MI'>
    <input class='standard' type='text' name='lastname' placeholder='Last Name' required><br>
    <input class='standard' type='email' name='email'  placeholder='E-Mail' required><br>
    <input class='standard' id='password' type='password' name='new-password'  placeholder='Password' required><br>
    <input class='standard' id='confirmation' type='password' name='passwordconfirm' placeholder='Confirm Password' required><br>


    <div class='addprofbox'>
      <p class='lable'>occupation</p>
      student<input type='radio' name='occupation' value='student' checked>
      &nbsp;&nbsp;&nbsp;
      professor<input type='radio' name ='occupation' value='professor'>
      <br><div id='addprofnote'>
        to be given profressor level editing abilities, please enter the code given to you by an administrator.<br>
        code<input class='standard' type='text' name='profcode'>
      </div>
    </div>
    <input class='standard' id='submission' type='submit' value='register account'>
    <p id='note'>Passwords must match</p>
  </form>
</div>
