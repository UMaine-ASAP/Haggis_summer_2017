<div>
  <?php if(isset($message)) echo $message; ?>
</div>
<table>
  <tr>
    <td class='catchPhrase' colspan='2'>
      Give critique with Haggis.
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
