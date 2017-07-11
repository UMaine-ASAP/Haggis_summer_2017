<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
  </head>
  <body>
    <header>
    </header>

    <div class = "body">
      <button onclick="goBack()">Return to previous page</button><br><br>

      <?php require_once('routes.php'); ?>
    </div>
    <footer>
      <div class = "content">
        Footer Text
      </div>
    </footer>
  </body>
  </html>

  <script>
  function goBack()
  {
    window.history.back();
  }
  </script>
