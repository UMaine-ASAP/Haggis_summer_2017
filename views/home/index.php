<div>
  <?php if(isset($message)) echo $message; ?>
</div>

<table>
  <tr>
    <td>
      <?php echo $loginStatus; ?>
    </td>
  </tr>
  <tr>
    <th>User Functions</th>
    <th>Class Functions</th>
    <th>Group Functions</th>
  </tr>
  <tr>
    <td><?php echo $userFunctions; ?></td>
    <td><?php echo $classFunctions; ?></td>
    <td><?php echo $groupFunctions; ?></td>
  </tr>
</table>
