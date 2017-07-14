<?php

class UserUpdate
{
  public static function update($input){
    $db= Db::getInstance();
    $sql = "UPDATE user SET firstName = ?, lastName = ?, middleInitial = ?, email = ?, userType = ? WHERE userID = ?";
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($input);
    }
    catch(PDOException $e)
    {
      echo "Error: ". $e->getMessage();
    }
  }
}
?>
