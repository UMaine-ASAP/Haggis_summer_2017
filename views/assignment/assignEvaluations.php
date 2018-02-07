You are now assigning an peeps to evaluate things

<?php
foreach($projects as $p)
{
  $isgroup = $p->isgroup;
  echo "<div>".$p->title;
  echo "<ul>";
    foreach($p->list as $l)
    {
      switch($isgroup)
      {
        case "1":                   //pulls from group model
          echo "in group mode <br>";
          foreach($l->users as $u)
          {
            echo "<li>".$u->firstName."</li>";
          }
          break;


        case "0":                   //pulls from projectUser model
          echo "in single mode <br>";
          foreach($l as $u)
          {
            echo "<li>".$u->firstName."</li>";
          }
          break;
      }
    }
    echo "</ul>";

  echo "</div>";
}
?>
