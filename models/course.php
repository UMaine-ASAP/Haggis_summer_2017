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
        $classes = Klass::courseid($result['courseID']);
        $courses[]= new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'], $classes );
      }
      return $courses;
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
      return new Course($result['courseID'],$result['title'],$result['courseCode'],$result['description'],$classes );
    }
  }
  ?>
