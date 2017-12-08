<?php
class EventUser
{
  public $id;
  public $userID;
  public $userLevel;
  public $eventID;
  public $firstName;
  public $middleInitial;
  public $lastName;
  public $email;
  //===================================================================================
  public function __construct($id, $userID, $userlevel, $eventID, $fn, $mi, $ln, $em)
  {
    $this->id = $id;
    $this->userID = $userID;
    $this->userLevel = $userlevel;
    $this->eventID = $eventID;
    $this->firstName = $fn;
    $this->middleInitial = $mi;
    $this->lastName = $ln;
    $this->email = $em;
  }
  //===================================================================================
  public static function  insert($fn, $mi, $ln, $em,$eid)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO eventUser (firstName, middleInitial, lastName, email,eventID) VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $data = array($fn, $mi, $ln, $em,$eid);

    try
    {
        $check = EventUser::getEmail($em)[1];
        $stmt->execute($data);
        $message = $db->lastInsertId();
        $errorCode= 1;
    }
    catch(PDOException $e)
    {
      $errorCode = $e->getCode();
      $message = $e->getMessage();
    }
    return array($errorCode, $message);
  }
  //===================================================================================
  public static function getEmail($em)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $data= array($em);
    $sql = "SELECT ID FROM eventUser WHERE email = ?";
    try
    {
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $errorCode = 1;
      $message = $stmt->fetch()['ID'];
    }
    catch(PDOException $e)
    {
      $errorCode  = $e->getCode();
      $message    = $e->getMessage();
    }
    return array($errorCode, $message);
  }
  //===================================================================================
  public static function eventID($id)
  {
    $db = Db::getInstance();
    $sql = "SELECT * FROM eventUser WHERE eventID = ?";
    $data = array($id);
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    $userlist = array();
    while($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $userlist[] =  new EventUser($result['ID'], $result['userID'],$result['userLevel'],$result['eventID'],$result['firstName'],$result['middleInitial'],$result['lastName'],$result['email']);
    }
    return array(1,$userlist);
  }
}
