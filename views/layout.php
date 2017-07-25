<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
    <link rel="stylesheet" type="text/css" href="css/defaultStyle.css">
  </head>
  <body>
    <header>
      <table>
        <tr>
          <td>
            <h1>Haggis_2017</h1>
          </td>
          <td>
          </td>
        </tr>
      </table>
    </header>

    <div class = "body">
      <form action="index.php">
          <input type="submit" value="Home" />
      </form>


      <?php require_once('routes.php'); ?>
    </div>
    <footer>
      <div class = "content">
        <!-- Footer Text -->
      </div>
    </footer>
  </body>
  </html>
