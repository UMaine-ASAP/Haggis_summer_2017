<table>
  <tr>
    <td id="catchPhrase">
      Give critique with Haggis.
    </td>
  </tr>
  <?php
  if (isset($_SESSION['token'])) {
    echo  "<tr><td class='buttonHolder'><div class='bigButton'>";
    echo  "<a href='?controller=mobile&action=classes'><button class='buttonLinkLarge'>My Classes</button></a></div></td></tr>";
  }
  ?>
  <tr>
    <td class='buttonHolder'>
      <div class="bigButton">
        <a href='?controller=mobile&action=events'>
          <button class='buttonLinkLarge'>Live Events</button>
        </a>
      </div>
    </td>
  </tr>
</table>
