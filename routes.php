<?php
  require_once('models/klass.php');         //we pull our models in and get them ready to be used by the controllers
  require_once('models/group.php');
  require_once('models/course.php');
  require_once('models/assignment.php');
  require_once('models/criteria.php');

  function call ($controller, $action)
  {

    require_once("controllers/".$controller."_controller.php");

    switch ($controller)
    {
      case 'pages':
        $controller = new PagesController();
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
      case 'assignment':
        $controller = new AssignmentController();
        break;
    }
    $controller->{$action}();
  }


  $controllers = array (  'pages'     => ['index','classes','groups','assignments','error'],
                          'user'      => ['index','register', 'passwordReset', 'passwordResetRequest','login','logout','editUser','delete','emailConfirmation', 'sendEmailConfirmation'],
                          'class'     => ['index', 'archiveClass', 'getUserbyClass', 'insertClass', 'joinClass', 'updateClass', 'listCourses', 'viewClass'],
                          'group'     => ['index', 'create','edit'],
                          'assignment'=> ['listAssignments', 'createAssignment','delete']);

  if(array_key_exists($controller, $controllers))
    if(in_array($action, $controllers[$controller]))
      call($controller, $action);
    else
      call('pages', 'error');
  else
    call('pages', 'error');

?>
