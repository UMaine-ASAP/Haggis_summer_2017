<DOCTYPE html>
  <html>
    <head>
      <meta content='width=device-width, initial-scale=1.0' name = 'viewport'/>
      <link rel="stylesheet" type="text/css" href="css/mobileBase.css">
      <link rel="stylesheet" type="text/css" href="css/mobileTopBar.css">
      <meta name ="HandheldFriendly" content = "true" />
    </head>

    <div class="overlay"></div>
    <header>
      <div class='header'>
        <div class='headerTitle'>
          <h1 class="pageTitle"><a class='pageTitle' href='index.php'>Haggis</a></h1>
        </div>


        <div class='headerLogin'>
          <?php
          if (isset($_SESSION['token'])) {
            echo  "<button class='login' href='?controller=user&action=logout'>log out</button>";
          } else {
            echo  "<button class='login' href='?controller=mobile&action=login'>Login/Sign Up</button>";
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
