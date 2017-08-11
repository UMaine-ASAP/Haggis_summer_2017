<?php
class Klass {  //We use class with a k, using just class confuses PHP
  public $id;
  public $title;
  public $courseid;
  public $courescode;
  public $coursename;
  public $timeStart;
  public $timeEnd;
  public $dateStart;
  public $dateEnd;
  public $description;
  public $location;
  public $joinCode;
  public $days;
//=================================================================================== STRUCT
  public function __construct($id, $title,$courseid, $coursename,$coursecode,$starttime, $endtime, $startdate, $enddate ,$description,$location,$joinCode) {
        $this->id = $id;
        $this->title = $title;
        $this->couresid = $courseid;
        $this->coursename= $coursename;
        $this->coursecode = $coursecode;
        $this->timeStart = substr($starttime, 0,5);;
        $this->timeEnd = substr($endtime, 0,5);
        $this->dateStart = $startdate;
        $this->dateEnd = $enddate;
        $this->description = $description;
        $this->location = $location;
        $this->joinCode = $joinCode;
        $days = Klass::getDays($id);
        $this->days = $days;
      }
//=================================================================================== CREATE
    public static function create($courseID, $startTime,$endTime, $startDate, $endDate, $classtitle, $classdescription, $location, $joinCode)
    {
      $message;
      $errorCode;
      $db = Db::getInstance();
      $sql = "INSERT INTO class (title, courseID, timeStart, timeEnd, dateStart, dateEnd, description, location, joinCode) VALUES (?,?,?,?,?,?,?,?,?)";
      try
      {
        $stmt = $db->prepare($sql);
        $data = array($classtitle, $courseID, $startTime,$endTime, $startDate, $endDate, $classdescription, $location,$joinCode);
        $stmt->execute($data);
        $errorCode = 1;
        $message =  $db->lastInsertId();
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $message = "error in Class Creation" .$e->getMessage();
      }
      return array($errorCode, $message);
    }
//=================================================================================== ASSOCIATE CLASS WITH DAY
    public static function associateWithDay($classID, $daysArray)
    {
        $message;
        $errorCode;
        $db = Db::getInstance();
        $sql = "INSERT INTO class_dayofWeek (classID, dayofWeekID) VALUES(?,?)";

        try
        {
          $stmt = $db->prepare($sql);
          foreach($daysArray as $day)
          {
            switch($day)
            {
              case "sunday":
                $data = array($classID, 1);
                break;
              case "monday":
                $data = array($classID, 2);
                break;
              case "tuesday":
                $data = array($classID, 3);
                break;
              case "wednesday":
                $data = array($classID, 4);
                break;
              case "thursday":
                $data = array($classID, 5);
                break;
              case "friday":
                $data = array($classID, 6);
                break;
              case "saturda":
                $data = array($classID, 7);
                break;
            }
            $stmt->execute($data);
          }
          $message = "class associated with days";
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }
//===================================================================================
    public static function getDays($classID)
    {
      $message = [];
      $db = Db::getInstance();
      $sql = "SELECT name FROM dayofweek  WHERE weekNameID IN (SELECT dayofWeekID FROM class_dayofweek WHERE classID = ?)";
      $data = array($classID);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetchAll();
        foreach($result as $r)
          $message[] = $r[0];
      return $message;

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
        $classes[]= new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle['title'], $coursetitle['corseCode'],$result['timeStart'],$result['timeEnd'],$result['dateStart'], $result['dateEnd'],$result['description'],$result['location'],$result['joinCode'] );
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
        $classes[]= new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle['title'], $coursetitle['courseCode'],$result['timeStart'],$result['timeEnd'],$result['dateStart'], $result['dateEnd'],$result['description'],$result['location'],$result['joinCode'] );
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
      return array(1, new Klass($result['classID'],$result['title'],$result['courseID'],$coursetitle['title'], $coursetitle['courseCode'],$result['timeStart'],$result['timeEnd'],$result['dateStart'], $result['dateEnd'],$result['description'],$result['location'],$result['joinCode'] ));
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
