<div><?php echo $message; ?></div>

<div>
  <form action='?controller=class&action=insertClass' method='post'>
    <input type='hidden'  name='token'        value = '<?php echo $_SESSION['token'];?>'>
    <input type='text'    name='title'        placeholder='Name of Class'>    <br>
    <input type='text'    name='courseid'     placeholder='Course ID'>        <br>
    <input type='time'    name='sessiontime'  placeholder='Meeting Time'>     <br>
    <input type='text'    name='description'  placeholder='Class Description'><br>
    <input type='text'    name='location'     placeholder='Class Location'>   <br>
    <input type='submit' value='Add Class'>
  </form>
</div>
