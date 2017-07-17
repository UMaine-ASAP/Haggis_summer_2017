<?php

class PullClass
{
  public static function all()
  {
    $courses = array();
    $db = Db::getInstance();
    $sql = "SELECT * FROM class";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $classes[]= new ClassObject($result['classID'],$result['title'],$result['courseID'],$result['sessionTime'],$result['description'],$result['location'] );
    }
    return $courses;
  }

  public static function courseid($id)
  {
    $classes = array();
    $db = Db::getInstance();
    $sql = "SELECT * FROM class WHERE courseID = ?";
    $data = array($id);
    $stmt = $db->prepare($sql);
    $stmt->execute($data);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $classes[]= new ClassObject($result['classID'],$result['title'],$result['courseID'],$result['sessionTime'],$result['description'],$result['location'] );
    }
    return $classes;
  }

  public static function classid($id)
  {
    $classes = array();
    $db = Db::getInstance();
    $sql = "SELECT * FROM course WHERE classID = ?";
    $data = array($id);
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return new ClassObject($result['classID'],$result['title'],$result['courseID'],$result['sessionTime'],$result['description'],$result['location'] );
  }
}
?>
