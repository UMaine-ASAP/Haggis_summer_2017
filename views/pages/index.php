
<table>
  <tr>
    <td class='catchPhrase' colspan='2'>
      Give critique with Haggis.<br>
      DEVELOPMENT
    </td>
  </tr>
  <tr>
    <td class ='error' colspan='2'>
      <?php echo $message; ?>
    </td>
  </tr>
  <tr>
    <td class='initialSquare'>
      <?php require_once('views/event/listActiveEvents.php'); ?>
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
