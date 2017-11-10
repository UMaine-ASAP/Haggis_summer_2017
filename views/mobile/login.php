<h1 class="currentPage">Login</h1>
<div> <?php if(isset($message)) echo $message; ?></div><br>
<form action="?controller=user&action=login" method="post">
  <div class="inputLogin"><input class="typeBox standard" type='email' name='email' placeholder='Email Address'></div>
  <div class="inputLogin"><input class="typeBox standard" type='password' name='password' placeholder='Password'></div>
  <div class="bigButton adjustBottom"><input class='bigButton' type='submit' value='Login'></div>
</form>
<p class="adjustBottom"><span>Don't have an account? <a class="smallButton" href="?controller=mobile&action=register">Sign Up</a></span></p> <!--Added this p tag so I could rearrange things. If it breaks things remove it. -->
