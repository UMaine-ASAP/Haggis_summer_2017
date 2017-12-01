<DOCTYPE html>
  <html>
    <head>
      <meta content='width=device-width, initial-scale=1.0' name = 'viewport'/>
      <!-- <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"> -->
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

    <div class="overlay"></div>
    <header>
      <script src="vendor/jquery.min.js"></script>
      <div class='header'>
        <div class='headerTitle'>
          <h1 class="pageTitle"><a class='pageTitle' href='index.php'>Haggis</a></h1>
        </div>


        <div class='headerLogin'>
          <?php
          if ($_SERVER['REQUEST_URI'] != "/index.php?controller=mobile&action=login") {
            if (isset($_SESSION['token'])) {
              echo  "<a class='logout' href='?controller=user&action=logout'>Logout</a>";
            } else {
              echo  "<a class='login' href='?controller=mobile&action=login'>Login/Sign Up</a>";
            }
          }
          ?>
        </div>
      </div>
    </header>
    <body>

    <?php require_once('routes.php'); ?>

    </body>
    <footer>
    <div class = "content"></div>
    </footer>
  </html>
