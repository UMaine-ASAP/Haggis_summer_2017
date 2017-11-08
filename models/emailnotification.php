<?php
class EmailNotification
{

  public static function sendEmail($sendto, $subject, $message)
  {
    $db = Db::getInstance();
    $to = $sendto->email;
    $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
    mail($to, $subject, $message, $headers);
    return array(1, "Notification Sent");
  }
}

?>
