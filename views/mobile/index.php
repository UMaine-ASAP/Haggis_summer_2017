<table>
  <tr>
    <td id="catchPhrase">
      Give critique with Haggis.
    </td>
  </tr>
  <?php
  if (isset($_SESSION['token'])) {
    echo  "<tr><td class='buttonHolder'><div class='bigButton'>";
    echo  "<a class='bigButton' href='?controller=mobile&action=classes'>My Classes</a></div></td></tr>";
  }
  ?>
  <tr>
    <td class='buttonHolder'>
      <div class="bigButton">
        <a class='bigButton' href='?controller=mobile&action=events'>
          Live Events
        </a>
      </div>
    </td>
  </tr>
</table>
