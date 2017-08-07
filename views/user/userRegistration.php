<h2>New User Registration</h2>
<div><?php echo $message; ?></div>
<div>
  <form action='?controller=user&action=register' method='post'>
    <input type='text' name='firstname' value='<?php echo $firstName; ?>' placeholder='First Name' autofocus required>
    <input type='text' name='middleinitial' value='<?php echo $middleInitial; ?>'maxlength='1' size = '1' placeholder='MI'>
    <input type='text' name='lastname' value='<?php echo $lastName; ?>'placeholder='Last Name' required><br>
    <input type='email' name='email' value='<?php echo $email; ?>' placeholder='E-Mail' required><br>
    <input type='password' name='password'  placeholder='Password' required><br>
    <input type='password' name='passwordconfirm' placeholder='Confirm Password' required><br>
    <input type='submit' value='Add User'>
  </form>
</div>
