<?php
class EmailNotification
{

  public static function sendEmail($to, $subject, $message)
  {
    $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
    mail($to, $subject, $message, $headers);
    return array(1, "Notification Sent");
  }
}

?>
