<?php
class CheckAdmin
{
  public static function check($token)
  {
    $db = Db::getInstance();
    $sql = "SELECT userType FROM user WHERE token = ?";
    $data = array($token);
    $stmt = $db->prepare($sql);
    $stmt ->execute($data);
    $output = false;

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result['userType'] == "admin")
    {
      $output = true;
    }
    return $output;
  }

}
?>
