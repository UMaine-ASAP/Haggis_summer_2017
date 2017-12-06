<?php
class Event
{
  public $id;
  public $title;
  public $description;
  public $startTime;
  public $endTime;
  public $startDate;
  public $endDate;
  public $active;
  public $transparancy;
  public $public;
  public $visible;
  public $registrationCode;

//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $startTime, $endTime, $starDate, $endDate, $active, $transparancy, $pubic, $visible, $registrationCode)
  {
    $this->id           = $id;
    $this->title        = $title;
    $this->description  = $description;
    $this->startTime    = $startTime;
    $this->endTime      = $endTime;
    $this->startDate    = $startDate;
    $this->endDate      = $endDate;
    $this->active       = $active;
    $this->transparancy = $transparancy;
    $this->public       = $public;
    $this->visible      = $visible;
    $this->registrationCode = $registrationCode;
  }
//=================================================================================== INSERT
  public static function  create($title, $description, $startTime, $endTime, $starDate, $endDate, $active, $transparancy, $pubic, $visible, $registrationCode)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO event (title, description, startTime, startDate, endDate, active, transparancy, public, visible, registrationCode) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $data = array($title, $description, $startTime, $endTime, $starDate, $endDate, $active, $transparancy, $pubic, $visible, $registrationCode);
    $stmt = $db->prepare($sql);
    try
    {
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

   //=================================================================================== GET BY ID
    public static function id($id)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "SELECT * FROM event WHERE ID = ?";
        $data = array($id);
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute($data);
          $evaluations = array();
          $r = $stmt->fetch(PDO::FETCH_ASSOC)

          $message = new Event($r['ID'], $r['title'], $r['description'], $r['startTime'], $r['endTime'], $r['startDate'],$r['endDate'],
                                $r['active'],$r['transparancy'], $r['public'], $r['visible'], $r['registrationCode']);
          $errorCode = 1;
        }
        catch(PDOException $e)
        {
          $errorCode = $e->getCode();
          $message = $e->getMessage();
        }
        return array($errorCode, $message);
    }
    //=================================================================================== get the Active Events
     public static function getActive()
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql = "SELECT * FROM event WHERE active = 1";
         try
         {
           $stmt = $db->prepare($sql);
           $stmt->execute($data);
           $events = array();

           while($r = $stmt->fetch(PDO::FETCH_ASSOC))
           {
             $events[] = new Event($r['ID'], $r['title'], $r['description'], $r['startTime'], $r['endTime'], $r['startDate'],$r['endDate'],
                                   $r['active'],$r['transparancy'], $r['public'], $r['visible'], $r['registrationCode']);
           }
           $message = $events;
           $errorCode = 1;
         }
         catch(PDOException $e)
         {
           $errorCode = $e->getCode();
           $message = $e->getMessage();
         }
         return array($errorCode, $message);
     }
}
