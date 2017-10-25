<DOCTYPE html>
  <html>
    <head>
      <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0, minimum-scale=0.2' name = 'viewport'/>
      <meta name ="HandheldFriendly" content = "true" />
    </head>

    <div class="overlay"></div>
    <header>
      <div class='header'>
        <div class='headerTitle'>
          <h1><a class='pageTitle' href=''>Haggis</a></h1>
        </div>


        <div class='headerLogin'>
          <?php
          if (isset($_SESSION['token'])) {
            echo  "<a href='?controller=user&action=logout'>log out</a>";
          } else {
            echo  "<a href='?controller=user&action=logout'>Login/Sign Up</a>";
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
