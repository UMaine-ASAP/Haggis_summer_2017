
<?php
  if(isset($_GET['quick']))
  {

    require_once('views/modules/scriptloader.php');
    require_once('routes.php');
  }
  else
  {

    ?>

<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0, minimum-scale=0.2' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
    <script src='js/tinymce/tinymce.min.js'></script>
    <script>tinymce.init({selector: '.fancyText'});</script>

    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/baseStyle.css">
    <link rel="stylesheet" type="text/css" href="css/input.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/project.css">
    <link rel="stylesheet" type="text/css" href="css/class.css">
    <link rel="stylesheet" type="text/css" href="css/group.css">
    <link rel="stylesheet" type="text/css" href="css/criteria.css">
    <link rel="stylesheet" type="text/css" href="css/assignment.css">
    <link rel="stylesheet" type="text/css" href="css/event.css">





    <?php
    switch($action)
    {
      case 'classes':
        $_SESSION['current'] = "Classes";
        if(isset($_GET['classID']))

        break;
      case 'groups':
        $_SESSION['current'] = "Groups";
        break;
      case 'assignments':
        $_SESSION['current'] = "Assignments";
        break;
      default:
        $_SESSION['current'] = "Home";
        break;
    }
    ?>

  </head>

        <div class="overlay"></div>
        <header>
          <script src="vendor/jquery.min.js"></script>

          <?php require_once('views/modules/header.php');?>
        </header>
        <body>
          <?php $sop = true; require_once('views/modules/scriptloader.php');?>
          <div class=spacer></div>
            <?php require_once('routes.php'); ?>
        </body>
        <footer>
          <div class = "content">
          </div>
        </footer>

  </html>
  <?php
    }
   ?>
