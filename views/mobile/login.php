<h1 class="currentPage">
  <a href="index.php" class="backButton">&lt;- Back</a>
  Login
</h1>
<div> <?php echo $message; ?></div><br>
<form action="?controller=user&action=login" method="post">
  <div class="inputLogin"><input class="typeBox standard" type='email' name='email' placeholder='Email Address'></div>
  <div class="inputLogin"><input class="typeBox standard" type='password' name='password' placeholder='Password'></div>
  <div class="bigButton"><input class='bigButton' type='submit' value='Login'></div><br><br>
  <a href="?controller=mobile&action=forgotPassword" style="text-align: center; width: 100%; display: block;">Forgot password?</a><br>
</form>
<p class="adjustBottom"><span>Don't have an account? <a class="smallButton" href="?controller=mobile&action=register">Sign Up</a></span></p>
