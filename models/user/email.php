<?php
class UserEmail
{

  public static function confirmEmail($code)
  {
    $db = Db::getInstance();
  $req = $db->prepare("UPDATE user SET emailConfirmed = '1', emailConfirmedCode ='' WHERE emailConfirmedCode = '$code'");
  $req->execute();

  }

  public static function sendConfirmEmail($email)
  {
    $db = Db::getInstance();
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < 19; $i++){
        $result .= $characters[mt_rand(0, 61)];
    }
  $req = $db->prepare("UPDATE user SET emailConfirmedCode = ? WHERE email = ?");
  $data = array($result, $email);
  $req->execute($data);

  $to = $email;
  $subject = 'Haggis Email confirmation';
  $message = 'You registered for an account. Click the link below to confirm your email address  ' .
  "chitna.asap.um.maine.edu/Haggis_summer_2017/?controller=user&action=emailConfirmation&code=$result" .
  "  If you didn't register for an account ignore this email";
  $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
  mail($to, $subject, $message, $headers);
  $message = "Check your e-mail for an email confirmation link";

  echo "<script> if(confirm('".$message."')) document.location = 'index.php'</script>";


  }

}
?>
