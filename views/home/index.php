<div>
  <?php if(isset($message)) echo $message; ?>
</div>

<table>
  <tr>
    <td>
      <div class = "menuLinks">
        User Functions<br>
        <ul>
          <li><a href="?controller=user&action=login">Login</a></li>
          <li><a href="?controller=user&action=logout">Logout</a></li>
          <li><a href="?controller=user&action=register">Register</a></li>
          <li><a href="?controller=user&action=editUser">Edit User</a></li>
          <li><a href="?controller=user&action=index">List Users</a></li>
          <li><a href="?controller=user&action=passwordResetRequest">Forgot Password?</a></li>
        </ul>
      </div>
    </td>
    <td>
      <?php

        if(isset($_SESSION['firstName']))
        {
          echo "Logged in as ". $_SESSION['firstName'] ." ". $_SESSION['middleInitial'] ." ". $_SESSION['lastName'];
          if(User::checkAdmin($_SESSION['token']))
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
</table>
