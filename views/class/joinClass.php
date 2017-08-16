
<h1>Join a Class</h1>
<hr>
To add classes, enter your class code below
<div> <?php if(isset($message)) echo $message; ?></div><br>
<div>
  <form method='post' action='?controller=class&action=joinClass'>
    <input class='joinedInputSmaller' type='text' name='classCode' placeholder='Enter Class Code'><button class='joinedButtonSmaller' type='submit'><i size='smaller' class="glyphicon glyphicon-plus" size='smaller'></i></button>
  </form>
</div>
