<?php
Class Content {
  public $id;
  public $name;
  public $format;
  public $size;
  public $location;
  public $data;
//=================================================================================== STRUCT
  public function __construct($id, $name, $format, $size,$location,$data) {
        $this->id = $id;
        $this->name = $name;
        $this->format = $format;
        $this->size = $size;
        $this->location = $location;
        $this->data = $data;

    }
//=================================================================================== CREATE
    public static function create($name, $format, $size, $location, $text)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO content (name, format, size, location, data) VALUES (?,?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($name, $format, $size, $location, $text);
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
        $contents[]= new Content($result['contentID'],$result['name'],$result['format'],$result['size'],$result['location'],$result['data']);
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
      return array(1, new Content($result['contentID'],$result['name'],$result['format'],$result['size'],$result['location'],$result['data']));
    }
  }
  ?>
