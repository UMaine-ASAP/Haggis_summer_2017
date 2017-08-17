<script src="java/userCreation.js"></script>
<div class='exit'><i class="glyphicon glyphicon-remove"></i></div>
<h2>New User Registration</h2><hr>

<div>
  <form action='?controller=user&action=register' method='post'>
    <input class='standard' type='text' name='firstname' placeholder='First Name' autofocus required>
    <input class='standard' type='text' name='middleinitial' maxlength='1' size = '1' placeholder='MI'>
    <input class='standard' type='text' name='lastname' placeholder='Last Name' required><br>
    <input class='standard' type='email' name='email'  placeholder='E-Mail' required><br>
    <input class='standard' id='password' type='password' name='password'  placeholder='Password' required><br>
    <input class='standard' id='confirmation' type='password' name='passwordconfirm' placeholder='Confirm Password' required><br>
    <input class='standard' id='submission' type='submit' value='Add User'>
    <p id='note'>Passwords must match</p>
  </form>
</div>
