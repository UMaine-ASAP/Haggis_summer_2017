<?php
Class Content {
  public $id;
  public $title;
  public $format;
  public $size;
  public $location;
  public $data;
  public $projectID;
  public $author;
  public $date;
  public $time;
//=================================================================================== STRUCT
  public function __construct($id, $name, $format, $size,$location,$data,$projectIDin, $authorin, $datein, $timein) {
        $this->id = $id;
        $this->title = $name;
        $this->format = $format;
        $this->size = $size;
        $this->location = $location;
        $this->data = $data;
        $this->projectID = $projectIDin;
        $this->author = User::id($authorin)[1];
        $this->time = date_format(date_create($timein), 'g:i a');
        $this->date = date_format(date_create($datein), 'm/d/Y');
    }
//=================================================================================== CREATE
    public static function create($name, $format, $size, $location, $text, $projectID, $author)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO content (name, format, size, location, data, projectID, author, date, time) VALUES (?,?,?,?,?,?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($name, $format, $size, $location, $text, $projectID, $author,date("Y-m-d"),date("H:i:s"));
          $stmt->execute($data);
          $contentIDfinal = $db->lastInsertId();

        $errorCode = 1;
        $dataOut = $contentIDfinal;
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
      $contents = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM content";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $contents[]= new Content($result['contentID'],$result['name'],$result['format'],$result['size'],$result['location'],$result['data'],$result['projectID'],$result['author'],$result['date'],$result['time']);
      }
      return array(1, $contents);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM content WHERE contentID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, new Content($result['contentID'],$result['name'],$result['format'],$result['size'],$result['location'],$result['data'],$result['projectID'],$result['author'],$result['date'],$result['time']));
    }
//=================================================================================== ALL
    public static function project($id)
    {
      $contents = array();
      $db = Db::getInstance();
      $sql = "SELECT * FROM content WHERE projectID = ?";
      $stmt = $db->prepare($sql);
      $data = array($id);
      $stmt->execute($data);

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $contents[]= new Content($result['contentID'],$result['name'],$result['format'],$result['size'],$result['location'],$result['data'],$result['projectID'],$result['author'],$result['date'],$result['time']);
      }
      return array(1, $contents);
    }
//=================================================================================== ALL
    public static function delete($id)
    {
      $db = Db::getInstance();
      $sql = "DELETE FROM content WHERE contentID = ?";
      $stmt = $db->prepare($sql);
      $data = array($id);
      $stmt->execute($data);
      return array(1, "Content Deleted");
    }
  }
  ?>
