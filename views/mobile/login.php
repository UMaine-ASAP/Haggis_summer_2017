<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php" class="backButton"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Login</h3>
  </div>
</div>



<div class='err'> <?php echo $message; ?></div><br>
<form action="?controller=user&action=login&mobile=true" method="post">
  <div class="inputLogin"><input class="typeBox standard" type='email' name='email' placeholder='Email Address'></div>
  <div class="inputLogin"><input class="typeBox standard" type='password' name='current-password' placeholder='Password'></div>
  <div class="bigButton"><input class='bigButton' type='submit' value='Login'></div><br><br>
  <a href="?controller=mobile&action=forgotPassword" style="text-align: center; width: 100%; display: block;">Forgot password?</a><br>
</form>
<p class="adjustBottom"><span>Don't have an account? <a class="smallButton" href="?controller=mobile&action=register">Sign Up</a></span></p>
