<?php

class PullCourse
{
  public static function all()
  {
    $courses = array();
    $db = Db::getInstance();
    $sql = "SELECT * FROM course";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $courses[]= new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'] );
    }
    return $courses;
  }

  public static function id($id)
  {
    $courses = array();
    $db = Db::getInstance();
    $sql = "SELECT * FROM course WHERE courseID = ?";
    $data = array($id);
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'] );
  }
}
?>
