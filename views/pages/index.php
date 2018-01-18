
<table>
  <tr>
    <td class='catchPhrase' colspan='2'>
      Give critique with Haggis.<br>
    </td>
  </tr>
  <tr>
    <td class ='error' colspan='2'>
      <?php echo $message; ?>
    </td>
  </tr>
  <tr>
    <td class='initialSquare'>
      <?php require_once('views/event/listEvents.php'); ?>
    </td>

    <?php if(isset($classes)) { ?>
      <td class='initialSquare'>
        <?php require_once('views/class/listClasses.php'); ?>
      </td>
    <?php
          }
          ?>
  </tr>
</table>
