<?php
class UserPassword
{
  public static function resetPassword($code, $password){
    $db = Db::getInstance();
    $salted = password_hash($pw, PASSWORD_DEFAULT);
  $req = $db->prepare("UPDATE user SET password = ?, resetCode = '' WHERE resetCode = ?");
  $data = array($salted, $code);
  $req->execute($data);
  }

  public static function sendResetEmail($email){
    $db = Db::getInstance();

  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < 19; $i++){
        $result .= $characters[mt_rand(0, 61)];
    }
  $req = $db->prepare("UPDATE user SET resetCode = '$result' WHERE email = '$email'");
  $req->execute();

  $to = $email;
  $subject = 'Haggis Password Reset';
  $message = 'You requested a password reset. If you requested a password reset click the link below.  ' .
  "chitna.asap.um.maine.edu/Haggis_summer_2017/?controller=user&action=passwordReset&code=$result" .
  "  If you didn't request a password reset ignore this email";
  $headers = 'From: no-reply@haggis.com' . "\r\n" . 'Reply-To: no-reply@haggis.com';
  mail($to, $subject, $message, $headers);
  $message = "Check your e-mail for a password reset link";

  echo "<script> if(confirm('".$message."')) document.location = 'index.php'</script>";

  }


}
?>
