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
      <?php echo $loginStatus; ?>
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
