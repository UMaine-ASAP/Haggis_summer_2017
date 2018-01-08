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
  public $criterias;

//=================================================================================== STRUCT
  public function __construct($id, $title, $description, $startTime, $endTime, $startDate, $endDate, $active, $transparancy, $public, $visible, $registrationCode)
  {
    $this->id           = $id;
    $this->title        = $title;
    $this->description  = $description;
    $this->startTime    = date_format(date_create($startTime), 'g:i a');
    $this->endTime      = date_format(date_create($endTime), 'g:i a');
    $this->startDate    = date_format(date_create($startDate), 'm/d/Y');
    $this->endDate      = date_format(date_create($endDate), 'm/d/Y');
    $this->active       = $active;
    $this->transparancy = $transparancy;
    $this->public       = $public;
    $this->visible      = $visible;
    $this->registrationCode = $registrationCode;
    $this->criterias    = Criteria::eventID($id);
  }
//=================================================================================== INSERT
  public static function  create($title, $description, $startTime, $endTime, $startDate, $endDate, $active, $transparancy, $public, $visible, $registrationCode)
  {
    $errorCode;
    $message;
    $db = Db::getInstance();
    $sql = "INSERT INTO event (title, description, startTime, endTime, startDate, endDate, active,
       transparancy, public, visible, registrationCode) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $data = array($title, $description, $startTime, $endTime, $startDate, $endDate, $active, $transparancy, $public, $visible, $registrationCode);
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
          $r = $stmt->fetch(PDO::FETCH_ASSOC);

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
     public static function getAll()
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql = "SELECT * FROM event";
         try
         {
           $stmt = $db->prepare($sql);
           $stmt->execute();
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
           $stmt->execute();
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
     //=================================================================================== set the Active status
      public static function setActive($eventID, $status)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "UPDATE event SET active = ? WHERE ID = ?";
          $data = array($status, $eventID);
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute($data);
            $message = "sucessful";
            $errorCode = 1;
          }
          catch(PDOException $e)
          {
            $errorCode = $e->getCode();
            $message = $e->getMessage();
          }
          return array($errorCode, $message);
      }
      //=================================================================================== set the Transparancy status
       public static function setTransparent($eventID, $status)
       {
           $errorCode;
           $message;
           $db = Db::getInstance();
           $sql = "UPDATE event SET transparancy = ? WHERE eventID = ?";
           $data = array($status, $eventID);
           try
           {
             $stmt = $db->prepare($sql);
             $stmt->execute($data);
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
       //=================================================================================== set the visible status
        public static function setVisible($eventID, $status)
        {
            $errorCode;
            $message;
            $db = Db::getInstance();
            $sql = "UPDATE event SET visible = ? WHERE eventID = ?";
            $data = array($status, $eventID);
            try
            {
              $stmt = $db->prepare($sql);
              $stmt->execute($data);
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

     //=================================================================================== get the Active Events
      public static function all()
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "SELECT * FROM event";
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute();
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
     //=================================================================================== Add Assignment to Event
     public static function addAssignment($eid, $aid)
     {
       $errorCode;
       $message;
       $db = Db::getInstance();
       $sql = "INSERT INTO event_assignment (eventID, assignmentID) VALUES (?,?)";
       $data = array($eid, $aid);
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
     //=================================================================================== get the Active Events
      public static function getAssignments($eventID)
      {
          $errorCode;
          $message;
          $db = Db::getInstance();
          $sql = "SELECT * FROM event_assignment WHERE eventID = ?";
          try
          {
            $stmt = $db->prepare($sql);
            $stmt->execute(array($eventID));
            $assignmentIDs = array();

            while($r = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              $assignmentIDs[] = $r['assignmentID'];
            }
            $message = $assignmentIDs;
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
     public static function getEventProjects($eventID)
     {
         $errorCode;
         $message;
         $db = Db::getInstance();
         $sql = "SELECT * FROM event_eventProject WHERE eventID = ?";
         try
         {
           $stmt = $db->prepare($sql);
           $stmt->execute(array($eventID));
           $eventProjectIDs = array();

           while($r = $stmt->fetch(PDO::FETCH_ASSOC))
           {
             $eventProjectIDs[] = $r['eventProjectID'];
           }
           $message = $eventProjectIDs;
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
    public static function delete($eventID)
    {
        $errorCode;
        $message;
        $db = Db::getInstance();
        $sql = "DELETE FROM event WHERE ID = ?";
        try
        {
          $stmt = $db->prepare($sql);
          $stmt->execute(array($eventID));
          $message = "Event Deleted";
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
