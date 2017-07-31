<?php
Class Course {
  public $id;
  public $title;
  public $code;
  public $description;
  public $classes;
//=================================================================================== STRUCT
  public function __construct($id, $title, $code, $description, $classes) {
        $this->id = $id;
        $this->title = $title;
        $this->code = $code;
        $this->description = $description;
        $this->classes = $classes;
    }
//=================================================================================== CREATE
    public static function create($coursetitle, $coursecode, $coursedescription)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO course (title, courseCode, description) VALUES (?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($coursetitle, $coursecode, $coursedescription);
          $stmt->execute($data);
          $courseIDfinal = $db->lastInsertId();

        $errorCode = 1;
        $dataOut = $courseIDfinal;
      }
      catch(PDOException $e)
      {
        $errorCode = $e->getCode();
        $dataOut = "Error: ". $e->getMessage();
      }
      return array($errorCode, $dataOut);
    }
//=================================================================================== ALL
    public static function all()
    {
      $courses = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM course";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $classes = Klass::courseid($result['courseID'])[1];
        $courses[]= new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'], $classes );
      }
      return array(1, $courses);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM course WHERE courseID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $classes = Klass::courseid($result['courseID']);
      return array(1, new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'],$classes ));
    }
  }
  ?>
