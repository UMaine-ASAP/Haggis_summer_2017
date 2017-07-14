<?php

class UserUpdate
{

  public static function update($fn, $ln, $mi, $em, $ut, $ui){
    $db= Db::getInstance();
    $data = array($fn, $ln, $mi, $em, $ut, $ui);
    $sql = "UPDATE user SET firstName = ?, lastName = ?, middleInitial = ?, email = ?, userType = ? WHERE userID = ?";
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
