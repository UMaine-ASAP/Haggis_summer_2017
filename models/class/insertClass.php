<?php

class AddClass
{
  public static function insert($title, $courseID, $sessionTime, $description, $location)
  {
    $db = Db::getInstance();
    $sql = "INSERT INTO class (title, courseID, sessionTime, description, location) VALUES (?,?,?,?,?)";
    try
    {
      $stmt = $db->prepare($sql);
      $data = array($title, $courseID, $sessionTime, $description, $location);
      $stmt->execute($data);
      return "Class has been added";
    }
    catch(PDOException $e)
    {
      return "Error: ". $e->getMessage();
    }
  }
}
?>
