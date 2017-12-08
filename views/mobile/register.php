<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php?controller=mobile&action=login" class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Sign Up</h3>
  </div>
</div>




<form action='?controller=user&action=register' method='post'>
  <div class="inputRegister inline push"><input class='typeBox firstLast standard' type='text' name='firstname' placeholder='First' autofocus required></div>
  <div class="inputRegister inline"><input class='typeBox MI standard' type='text' name='middleinitial' maxlength='1' size = '1' placeholder='MI'></div>
  <div class="inputRegister inline"><input class='typeBox firstLast standard' type='text' name='lastname' placeholder='Last' required><br></div>
  <div id="email" class="inputRegister"><input class='typeBox' type='email standard' name='email'  placeholder='E-Mail' required><br></div>
  <div class="inputRegister"><input class='typeBox' id='password' type='password' name='password'  placeholder='Password' required><br></div>
  <div class="inputRegister"><input class='typeBox' id='confirmation' type='password' name='passwordconfirm' placeholder='Confirm Password' required><br></div>
  <div class="bigButton adjustTop"><input class='bigButton' id='submission' type='submit' value='Create Account'></div>
  <p id='note'>Passwords must match.</p>
</form>
