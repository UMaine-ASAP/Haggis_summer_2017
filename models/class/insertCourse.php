<?php

class AddCourse
{
  public static function insert($coursetitle, $coursecode, $coursedescription)
  {
    $courseIDfinal = '';
    $db = Db::getInstance();
    $sql = "INSERT INTO course (title, courseCode, description) VALUES (?,?,?)";
    try
    {
        $stmt = $db->prepare($sql);
        $data = array($coursetitle, $coursecode, $coursedescription);
        $stmt->execute($data);
        $courseIDfinal = $db->lastInsertId();

      return $courseIDfinal;
    }
    catch(PDOException $e)
    {
      return "Error: ". $e->getMessage();
    }
  }
}
?>
