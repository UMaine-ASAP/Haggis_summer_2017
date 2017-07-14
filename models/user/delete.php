<?php
class UserDelete
{
  public static function id($id)
  {
    $db = Db::getInstance();
    $sql = "DELETE FROM user WHERE userID = ?";
    $data = array($id);
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
    }
    catch(PDOException $e)
    {
      echo "Error: ". $e->getMessage();
    }
  }

}
?>
