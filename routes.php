<?php
  require_once('models/klass.php');         //we pull our models in and get them ready to be used by the controllers
  require_once('models/group.php');
  require_once('models/course.php');
  require_once('models/assignment.php');
  require_once('models/criteria.php');
  require_once('models/criteriaSet.php');
  require_once('models/projectUser.php');
  require_once('models/project.php');
  require_once('models/eventUser.php');
  require_once('models/part.php');
  require_once('models/content.php');
  require_once('models/user.php');
  require_once('models/evaluate.php');
  require_once('models/emailnotification.php');
  require_once('models/event.php');
  require_once('models/eventProject.php');

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
      case 'mobile':
        $controller = new MobileController();
        break;
      case 'evaluate':
        $controller = new EvaluateController();
        break;
      case 'project':
        $controller = new ProjectController();
        break;
      case 'event':
        $controller = new EventController();
        break;
    }
    $controller->{$action}();
  }


  $controllers = array (  'pages'     => ['index','classes','groups','assignments', 'events','error'],
                          'user'      => ['index','register', 'passwordReset', 'passwordResetRequest','login','logout','editUser','delete','emailConfirmation', 'sendEmailConfirmation'],
                          'class'     => ['index', 'archiveClass', 'getUserbyClass', 'insertClass', 'joinClass','addToClass', 'updateClass', 'listCourses', 'viewClass'],
                          'group'     => ['index', 'create','edit'],
                          'assignment'=> ['listAssignments', 'createAssignment','createAssignmentQuick','delete','editAssignment','viewAssignment','details'],
                          'mobile'    => ['index', 'login', 'register', 'classes', 'joinClass', 'assignments', 'projects', 'evaluate', 'responses', 'forgotPassword', 'events', 'eventSubmit'],
                          'evaluate'  => ['submit'],
                          'project'   => ['registerAssignment', 'registerEvent','edit','eventEvaluate','assignmentEvaluate','viewResponses','viewAssignmentProject', 'viewEventProject','saveEventResponse', 'saveAssignmentResponse'],
                          'event'     => ['add', 'showProjects', 'addAssignment','createEvent', 'setActive']);

  if(array_key_exists($controller, $controllers))
    if(in_array($action, $controllers[$controller]))
      call($controller, $action);
    else
      call('pages', 'error');
  else
    call('pages', 'error');

?>
