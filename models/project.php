
<?php
Class Project {
  public $id;
  public $title;
  public $isgroup;
  public $description;
  public $assignmentID;
  public $list;
//=================================================================================== STRUCT
  public function __construct($id, $title, $description,$isgroupin, $assignmentIDin, $listin) {
        $this->id = $id;
        $this->title = $title;
        $this->isgroup = $isgroupin;
        $this->description = $description;
        $this->assignmentID = $assignmentIDin;
        $this->list = $listin;
    }


//=================================================================================== CREATE
    public static function create($title, $description, $isgroup, $assignmentID)
    {
      $courseIDfinal = '';
      $errorCode;
      $dataOut;
      $db = Db::getInstance();
      $sql = "INSERT INTO project (title, description, isGroup, assignmentID) VALUES (?,?,?,?)";
      try
      {
          $stmt = $db->prepare($sql);
          $data = array($title, $description, $isgroup, $assignmentID);
          $stmt->execute($data);
          $projectIDfinal = $db->lastInsertId();

        $errorCode = 1;
        $dataOut = $projectIDfinal;
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
      $sql = "SELECT * FROM project";
      $stmt = $db->prepare($sql);
      $stmt->execute();

      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $courses[]= new Project($result['projectID'],$result['title'],$result['description'],$result['isgroup'],$result['assignmentID']);
      }
      return array(1, $courses);
    }
//=================================================================================== ID
    public static function id($id)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM project WHERE projectID = ?";
      $data = array($id);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $project;

      switch($result['isGroup'])
      {
        case '0':
          $projectuserlist = ProjectUser::project($id)[1];
          $project = new Project($result['projectID'],$result['title'],$result['description'],$result['isGroup'],$result['assignmentID'], $projectuserlist);
          break;
        case '2':
          $project = new Project($result['projectID'],$result['title'],$result['description'],$result['isGroup'],$result['assignmentID'], EventUser::eventID($result['projectID'])[1]);
          break;
        default:
          $project = new Project($result['projectID'],$result['title'],$result['description'],$result['isGroup'],$result['assignmentID'], Group::getByProjectID($result['projectID'])[1]);
          break;
      }
      return array(1, $project);
    }
    //=================================================================================== assignmentID
    public static function assignment($assignmentid)
    {
      $db = Db::getInstance();
      $sql = "SELECT * FROM project WHERE assignmentID = ?";
      $data = array($assignmentid);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $projectlists = array();
      while($result = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        if($result['isGroup'] === '0')
        {
            $projectlists[] =new Project($result['projectID'],$result['title'],$result['description'],$result['isGroup'],$result['assignmentID'], ProjectUser::project($result['projectID'])[1]);
        }
        else
        {
            $projectlists[] = new Project($result['projectID'],$result['title'],$result['description'],$result['isGroup'],$result['assignmentID'], Group::getByProjectID($result['projectID'])[1]);
        }
      }
      return array(1, $projectlists);
    }
    //=================================================================================== getassignmentID
    public static function getAssignment($projectID)
    {
      $message;
      $db = Db::getInstance();
      $sql = "SELECT assignmentID FROM project WHERE projectID = ?";
      $data = array($projectID);
      $stmt = $db->prepare($sql);
      $stmt->execute($data);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return array(1, $result['assignmentID']);
    }
  }
?>
