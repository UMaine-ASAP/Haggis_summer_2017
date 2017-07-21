<?php
  require_once('models/userFunctionAccess.php');
  require_once('models/classFunctionAccess.php');
  require_once('models/groupFunctionAccess.php');
  function call ($controller, $action)
  {
    require_once("controllers/".$controller."_controller.php");

    switch ($controller)
    {
      case 'home':
        $controller = new HomeController();
        break;
      case 'user':
        $controller = new UserController();
        break;
      case 'class':
        $controller = new ClassController();
        break;
      case 'group':
        $controller = new GroupController();
        break;
    }
    $controller->{$action}();
  }


  $controllers = array (  'home'      => ['index','error'],
                          'user'      => ['index','register', 'passwordReset', 'passwordResetRequest','login','logout','editUser','delete','emailConfirmation', 'sendEmailConfirmation'],
                          'class'     => ['index', 'archiveClass', 'getUserbyClass', 'insertClass', 'joinClass', 'updateClass', 'listCourses'],
                          'group'     => ['index', 'create']);

  if(array_key_exists($controller, $controllers))
    if(in_array($action, $controllers[$controller]))
      call($controller, $action);
    else
      call('home', 'error');
  else
    call('home', 'error');

?>
