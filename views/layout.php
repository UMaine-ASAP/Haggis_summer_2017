<DOCTYPE html>
  <html>
  <head>
    <meta content='width=device-width, intial-scale=1.0, maximum-scale=1.0' name = 'viewport'/>
    <meta name ="HandheldFriendly" content = "true" />
    <link rel="stylesheet" type="text/css" href="css/defaultStyle.css">

  </head>
  <body>

      <table>
        <tr class = "header">
          <td>
            <h1><a class='title' href='index.php'>Haggis_2017</a></h1>
          </td>
          <td class='sessionStat'>
            <?php
              echo $sessionData[1][0];
            ?>
          </td>
        </tr>
        <tr>
          <td class='menu'>

            Navigation<br>
            <ul>
              <li><a href ="?controller=pages&action=classes">Your Classes</a></li>
              <li><a href ="?controller=pages&action=assignments">Your Assigments</a></li>
              <li><a href ="?controller=pages&action=groups">Your Groups </a></li>
            </ul>

            Administration<br>
            <?php
              echo "<ul>";
              foreach($sessionData[1][1]->user as $option)
                echo "<li>".$option."</li>";
              echo "</ul><ul>";
              foreach($sessionData[1][1]->group as $option)
                echo "<li>".$option."</li>";
              echo "</ul><ul>";
              foreach($sessionData[1][1]->class as $option)
                echo "<li>".$option."</li>";
              echo "</ul>";
            ?>
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
