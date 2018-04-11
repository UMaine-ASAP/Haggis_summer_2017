<DOCTYPE html>
  <html>
    <head>
      <meta content='width=device-width, initial-scale=1.0' name = 'viewport'/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/mobileBase.css">
      <link rel="stylesheet" type="text/css" href="css/mobileTopBar.css">
      <link rel="stylesheet" type="text/css" href="css/mobileButton.css">
      <link rel="stylesheet" type="text/css" href="css/mobileInput.css">
      <link rel="stylesheet" type="text/css" href="css/mobileClasses.css">
      <link rel="stylesheet" type="text/css" href="css/mobileAssignments.css">
      <link rel="stylesheet" type="text/css" href="css/mobileProjects.css">
      <link rel="stylesheet" type="text/css" href="css/mobileEvaluations.css">
      <meta name ="HandheldFriendly" content = "true" />
    </head>

    <header>
      <script src="vendor/jquery.min.js"></script>
        <div class='headerTitle'>
          <a class='pageTitle' href='index.php'>Haggis</a>
        </div>

        <div class='headerMenu'>
          <?php
          $loginActive = false;
          if($loginActive == true)
            if ($_SERVER['REQUEST_URI'] != "/index.php?controller=mobile&action=login")
            {
              if (isset($_SESSION['token']))
              {
                echo  "<a href='?controller=user&action=logout'><button class='logout'> Logout</button></a>";
              }
              else
              {
                echo  "<a href='?controller=mobile&action=login'><button class='login'> Login/Sign Up</button></a>";
              }
            }
          ?>
        </div>
    </header>

    <body>
      <?php require_once('routes.php'); ?>
    </body>

    <footer>
      <div class = "content"></div>
    </footer>

  </html>
