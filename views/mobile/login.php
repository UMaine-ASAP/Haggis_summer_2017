<div class='titlespan'>
<div class='bbcontainer'>
  <a href="index.php"><button class='buttonLink'><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
</div>
  <div class='currpagecontainer'>
    <h3 class="currentPage">Login</h3>
  </div>
</div>



<div class='err'> <?php echo $message; ?></div><br>
<div class='logincontainer'>
<form action="?controller=user&action=login&mobile=true" method="post">
  <div class="inputLogin"><input class="typeBox standard" type='email' name='email' placeholder='Email Address'></div>
  <div class="inputLogin"><input class="typeBox standard" type='password' name='current-password' placeholder='Password'></div>
  <input class='buttonLinkLarge' type='submit' value='Login'><br><br>
  <a href="?controller=mobile&action=forgotPassword"><button class='buttonLink'>Forgot password?</button></a><br>
</form>
<p class="adjustBottom"><span>Don't have an account? <a href="?controller=mobile&action=register"><button class='buttonLink'>Sign Up</button></a></span></p>
</div>
