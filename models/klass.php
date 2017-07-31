<?php
class Klass {  //We use class with a k, using just class confuses PHP
  public $id;
  public $title;
  public $courseid;
  public $sessionTime;
  public $description;
  public $location;
//=================================================================================== STRUCT
  public function __construct($id, $title,$courseid,$sessiontime,$description,$location) {
        $this->id = $id;
        $this->title = $title;
        $this->couresid = $courseid;
        $this->sessionTime = $sessiontime;
        $this->description = $description;
        $this->location = $location;
//=================================================================================== CREATE
    }public static function create($courseID, $sessionTime, $classtitle, $classdescription, $location)
    {

      $db = Db::getInstance();
      $sql = "INSERT INTO class (title, courseID, sessionTime, description, location) VALUES (?,?,?,?,?)";
      try
      {
        $stmt = $db->prepare($sql);
        $data = array($classtitle, $courseID, $sessionTime, $classdescription, $location);
        $stmt->execute($data);
        return "Class has been added";
      }
      catch(PDOException $e)
      {
        return "Error: ". $e->getMessage();
      }
    }
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
//=================================================================================== COURSE ID
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
        $classes[]= new Klass($result['classID'],$result['title'],$result['courseID'],$result['sessionTime'],$result['description'],$result['location'] );
      }
      return $classes;
    }
//=================================================================================== CLASS ID
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
