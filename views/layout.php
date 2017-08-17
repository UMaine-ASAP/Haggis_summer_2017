<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0, minimum-scale=0.2' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/baseStyle.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/input.css">
    <link rel="stylesheet" type="text/css" href="css/class.css">
    <link rel="stylesheet" type="text/css" href="css/group.css">


    <?php
    switch($action)
    {
      case 'classes':
        $_SESSION['current'] = "Classes";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="java/popup.js"></script>
    <?php require_once('inserts/header.php');?>
  </header>
  <body>
    
    <table>
      <tr>
        <td class='currentAction'>
          <?php require_once('inserts/currentAction.php');?>
        </td>
      </tr>
      <tr>
        <td>
          <?php require_once('routes.php'); ?>
        </td>
      </tr>
    </table>
  </body>
  <footer>
    <div class = "content">
    </div>
  </footer>
  </html>
