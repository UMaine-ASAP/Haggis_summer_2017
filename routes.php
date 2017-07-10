<?php
  function call ($controller, $action)
  {
    require_once("controllers/".$controller."_controller.php");

    switch ($controller)
    {
      case 'home':
        $controller = new HomeController();
        break;
      case 'user':
        require_once('models/user.php');
        $controller = new UserController();
        break;
    }
    $controller->{$action}();
  }

  $controllers = array (  'home'      => ['index','error'],
                          'user'      => ['index','register','insertUser']);

  if(array_key_exists($controller, $controllers))
    if(in_array($action, $controllers[$controller]))
      call($controller, $action);
    else
      call('home', 'error');
  else
    call('home', 'error');

?>
