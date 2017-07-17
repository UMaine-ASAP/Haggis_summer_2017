<div>
  <?php if(isset($message)) echo $message; ?>
</div>

<table>
  <tr>
    <td>
      <div class = "menuLinks">
        User Functions<br>
        <ul>
          <?php echo $userFunctions; ?>
        </ul>
      </div>
    </td>
    <td>
      <?php

        if(isset($user))
        {
          echo "Logged in as ". $_SESSION['firstName'] ." ". $_SESSION['middleInitial'] ." ". $_SESSION['lastName'];
          if($user)
            echo "<br>ADMIN USER";
          else
            echo "<br>NON ADMIN";
        }

        else
        {
          echo "Not Logged in";
        }



      ?>
    </td>
  </tr>
  <tr>
    <td>
      <div class = "menuLinks">
        Class Functions<br>
        <ul>
          <?php echo $classFunctions; ?>
        </ul>
      </div>
    </td>
  </tr>
</table>
