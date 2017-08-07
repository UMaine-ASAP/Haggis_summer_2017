<?php
class Klass {  //We use class with a k, using just class confuses PHP
  public $id;
  public $title;
  public $courseid;
  public $coursename;
  public $sessionTime;
  public $description;
  public $location;
//=================================================================================== STRUCT
  public function __construct($id, $title,$courseid, $coursename,$sessiontime,$description,$location) {
        $this->id = $id;
        $this->title = $title;
        $this->couresid = $courseid;
        $this->coursename= $coursename;
        $this->sessionTime = $sessiontime;
        $this->description = $description;
        $this->location = $location;
//=================================================================================== CREATE
    }public static function create($courseID, $sessionTime, $classtitle, $classdescription, $location)
    {
      $message;
      $errorCode;
      $db = Db::getInstance();
      $sql = "INSERT INTO class (title, courseID, sessionTime, description, location) VALUES (?,?,?,?,?)";
      try
      {
        $stmt = $db->prepare($sql);
        $data = array($classtitle, $courseID, $sessionTime, $classdescription, $location);
        $stmt->execute($data);
        $errorCode = 1;
        $message =  "Class has been added";
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== ALL
    public static function all()
    {
      $classes = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM class";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $coursetitle = Course::getCourseName($result['courseID'])[1];
        $classes[]= new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle,$result['sessionTime'],$result['description'],$result['location'] );
      }
      return array(1, $classes);
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
        $coursetitle = Course::getCourseName($result['courseID'])[1];
        $classes[]= new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle,$result['sessionTime'],$result['description'],$result['location'] );
      }
      return array(1, $classes);
    }
//=================================================================================== CLASS ID
    public static function classid($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM class WHERE classID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $coursetitle = Course::getCourseName($result['courseID'])[1];
      return array(1, new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle,$result['sessionTime'],$result['description'],$result['location'] ));
    }
//=================================================================================== CLASSES FOR USER
    public static function userClasses($token)
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $userID = User::getID($token)[1];
      $sql = "SELECT classID FROM classUser WHERE userID = ?";
      $data = array($userID);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $output = array();
        while($result = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $output[] = Klass::classid($result['classID'])[1];
        }
        $message = $output;
        $errorCode = 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e -> getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== JOIN CLASS
    public static function joinClass($userID, $classID)
    {
      echo $userID." ".$classID;
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "INSERT INTO classUser (classID, userID) VALUES (?,?)";
      $data = array($classID, $userID);
      try
      {
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        $message = "Successfully Joined Class";
        $errorCode = 1;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = $e -> getMessage();
      }
      return array($errorCode, $message);
    }
  }
  ?>
