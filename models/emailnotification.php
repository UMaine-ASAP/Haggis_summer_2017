<?php
class EmailNotification
{

  public static function sendEmail($to, $subject, $message)
  {
    $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
    echo '<script language="javascript">';
    echo 'alert("'.$to.'")';
    echo '</script>';
    mail($to, $subject, $message, $headers);

    return array(1, "Notification Sent");
  }
}

?>
