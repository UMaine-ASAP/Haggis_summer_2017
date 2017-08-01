<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0, minimum-scale=0.2' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
    <link rel="stylesheet" type="text/css" href="css/defaultStyle.css">

  </head>
  <body>
    <header>
      <table class="header">
        <tr>
          <td>
            <h1><a class='title' href='index.php'>Haggis_2017</a></h1>
          </td>
          <td class='sessionStat'>
            <?php require_once('inserts/login.php');?>
          </td>
        </tr>
      </table>
    </header>
      <table>
        <tr>
          <td class='menu'>
            <?php require_once('inserts/menu.php');?>
          </td>
          <td>
            <?php require_once('routes.php'); ?>
          </td>
        </tr>
      </table>

    <footer>
      <div class = "content">
      </div>
    </footer>
  </body>
  </html>
