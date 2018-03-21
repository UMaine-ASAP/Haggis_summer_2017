<?php
class ProjectController
{
  //===================================================================================
  public function registerAssignment()
  {
    if(isset($_POST['targetid']))
    {
      $assignmentID = $_POST['targetid'];
      $title = $_POST['projectname'];
      $desc = $_POST['projectdesc'];
      //$abst = $_POST['abst'];
      //$PI = $_POST['principleInvestigator'];
      $fn = $_POST['firstName'];
      $mi = $_POST['middleInitial'];
      $ln = $_POST['lastname'];
      $em = $_POST['email'];
      $projectID = EventProject::create($title, $desc,'', "-2", '0')[1];
      for($i = 0; $i < sizeof($fn); $i++)
      {
        $temp = EventUser::insert($fn[$i], $mi[$i], $ln[$i], $em[$i],$projectID)[1];
        EventProject::associatewitheventuser($projectID, $temp);

      }
      echo "<div class='projectRegistration'><h2>Project Successfully Submitted</h2></div>";
    }
    else
    {
      $assignment = Assignment::id($_GET['target'])[1];
      require_once('views/project/registerAssignmentProject.php');
    }
  }
  //===================================================================================
  public function registerEvent()
  {
    if(isset($_POST['targetid']))
    {
      $eventID = $_POST['targetid'];
      $title = $_POST['projectname'];
      $desc = $_POST['projectdesc'];
      $abst = " ";//$_POST['abst'];
      //$PI = $_POST['principleInvestigator'];
      $fn = $_POST['firstName'];
      $mi = $_POST['middleInitial'];
      $ln = $_POST['lastname'];
      $em = $_POST['email'];
      $eventprojectID = EventProject::create($title, $desc,$abst,'-2', '0')[1]."<br>";
      EventProject::associatewithevent($eventprojectID, $eventID)[1]."<br>";
      for($i = 0; $i < sizeof($fn); $i++)
      {
        $temp = EventUser::insert($fn[$i], $mi[$i], $ln[$i], $em[$i],$eventprojectID)[1];
        EventProject::associatewitheventuser($eventprojectID, $temp);

      }
      echo "<div class='projectRegistration'><h2>Project Successfully Submitted</h2></div>";
      //echo("<script>location.href = '?controller=project&action=registerEvent&target=".$eventID."';</script>");
    }
    else
    {
      $e = Event::id($_GET['target'])[1];

      require_once('views/project/registerEventProject.php');
    }
  }

  //===================================================================================
  public function edit()
  {

  }

  //===================================================================================
  public function refreshList()
  {
    $projectID = $_GET['projectID'];
    $assignmentID = Project::getAssignment($projectID)[1];
    $a = Assignment::id($assignmentID)[1];
    $type = $a->type;
    $stype = ($type == "submission" ? "1" : "2");
    $evaluated = Evaluate::getEvaluated(User::getID($_SESSION['token'])[1], $stype, '1')[1];
    require_once('views/project/viewAssignmentProjectList.php');
  }
  //===================================================================================
  public function saveEventResponse()
  {

    $type = $_GET['type'];
    $projectid = $_GET['id'];
    $project;
    $projectresponses;
    if($type =='1')
    {
      $projectresponses = Evaluate::projectID($projectid)[1];
      $project = Project::id($projectid)[1];
    }
    if($type == '2')
    {
      $projectresponses = Evaluate::eventProjectID($projectid)[1];
      $project = EventProject::id($projectid)[1];
    }


    $cID = array();
    $cNames = array();
    $cAvg = array();
    $cComments = array();
    $dataout = array();

    foreach($projectresponses as $r)
    {
      $temp = Criteria::id($r->criteriaID)[1];

      $check = in_array($temp->title, $cNames);
      $author = $r->author;
        if($check)
        {
          $index = array_search($temp->title, $cNames);
          $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
          if($type == '2')
          {
            $cComments[$index][] = "-- ".$r->comment;
          }
          else
          {
            $cComments[$index][] = $r->comment." --".$author->firstName." ".$author->lastName;
          }
        }
        else
        {
          $cID[] = $temp->id;
          $cNames[] = $temp->title;
          $cAvg[] = $r->rating;
          if($type == '2')
          {
            $cComments[] = array("-- ".$r->comment);
          }
          else
          {
            $cComments[] = array($r->comment." --".$author->firstName." ".$author->lastName);
          }
        }
    }
    for($i = 0; $i<sizeof($cNames);$i++)
    {
      $dataout[]= array('lable' => $cNames[$i], 'rating' => $cAvg[$i]);
    }
      require_once('views/project/saveEventProject.php');
  }
  //===================================================================================
  public function saveAssignmentResponse()
  {
    $type = $_GET['type'];
    $projectid = $_GET['id'];
    $project;
    $projectresponses;
    if($type =='1')
    {
      $projectresponses = Evaluate::projectID($projectid)[1];
      $project = Project::id($projectid)[1];
    }
    if($type == '2')
    {
      $projectresponses = Evaluate::eventProjectID($projectid)[1];
      $project = EventProject::id($projectid)[1];
    }


    $cID = array();
    $cNames = array();
    $cAvg = array();
    $cComments = array();
    $dataout = array();

    foreach($projectresponses as $r)
    {

      $temp = CriteriaSet::id($r->criteriaID)[1][0];

      $check = in_array($temp->title, $cNames);
      $author = $r->author;
        if($check)
        {
          $index = array_search($temp->title, $cNames);
          $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
          if($type == '2')
          {
            $cComments[$index][] = "-- ".$r->comment;
          }
          else
          {
            $cComments[$index][] = $r->comment." --".$author->firstName." ".$author->lastName;
          }
        }
        else
        {
          $cID[] = $temp->id;
          $cNames[] = $temp->title;
          $cAvg[] = $r->rating;
          if($type == '2')
          {
            $cComments[] = array("-- ".$r->comment);
          }
          else
          {
            $cComments[] = array($r->comment." --".$author->firstName." ".$author->lastName);
          }
        }
    }
    for($i = 0; $i<sizeof($cNames);$i++)
    {
      $dataout[]= array('lable' => $cNames[$i], 'rating' => $cAvg[$i]);
    }
  }
  //===================================================================================
  public function assignmentEvaluate()
  {
    $projectid = $_GET['id'];
    $type = $_GET['type'];
    $assignmentid = $_GET['assignmentid'];
    $userID = User::getID($_SESSION['token'])[1];
    $targetid;
    $project;



    // if($userID == "-1")
    // {
    //   echo "<script> var username = prompt('You have been logged out due to inactivity.\nTo continue enter your email address below,'')";
    // }
    if($type != "3")
    {

      $project = Project::id($projectid)[1];
      $targetid= $project->assignmentID;
    }
    else
    {

      $targetid = $projectid;
    }

    $a = Assignment::id($assignmentid)[1];
    $criterias = $a->rubric->criteriaSets;
    $projectresponses = Evaluate::projectID($projectid)[1];

    $critiques = Evaluate::getPrexisting($userID, $projectid)[1];
    $returner = false;
    if($critiques != false)
      $returner=true;
    //create check and return of evaluation. check by UserId, projectID - Get all responses

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function eventEvaluate()
  {
    $projectid = $_GET['id'];
    $project = Project::id($projectid)[1];
    $rubric = Rubric::eventID($_GET['eventID'])[1];
    $criterias = $rubric->criteriaSets;
    $targetid = $_GET['eventID'];
    $projectresponses = Evaluate::projectID($project->id,'2')[1];
    $type = '2';

    require_once("views/project/evaluateProject.php");
  }
  //===================================================================================
  public function viewResponses()
  {
    $admin = User::checkAdmin($_SESSION['token'])[1];
    $type = $_GET['type'];
    $projectid = $_GET['id'];
    $project;
    $projectresponses;

    switch($type)
    {
      case '1':
        $projectresponses = Evaluate::projectID($projectid)[1];
        $project = Project::id($projectid)[1];
        break;
      case '2':
        $projectresponses = Evaluate::eventProjectID($projectid)[1];
        $project = EventProject::id($projectid)[1];
        break;
      case '3':
        $projectresponses = Evaluate::userID($projectid)[1];
        $project = Project::id($projectid)[1];
        break;
    }



    $cID = array();
    $cNames = array();
    $cAvg = array();
    $cComments = array();
    $cRatings = array();
    $dataout = array();

    foreach($projectresponses as $r)
    {

      $temp = CriteriaSet::id($r->criteriaID)[1][0];

      $check = in_array($temp->title, $cNames);
      $author = $r->author;
        if($check)
        {
          $index = array_search($temp->title, $cNames);
          $cAvg[$index] = number_format((($cAvg[$index] + $r->rating)/2),2,'.','');
          if($type == '2')
          {
            $cComments[$index][] = $r->comment;
          }
          else
          {
            $tempText = "<p>";
            if($admin)
            {
              if(isset($author->firstName) && isset($author->lastName))
                $tempText .= $author->firstName." ".$author->lastName." - <q>";
              else {
                $tempText .= "Author not logged - <q>";
              }
            }
            else
            {
              $tempText.= "<q>";
            }
            $tempText .= $r->comment."</q></p>";

            $cComments[$index][] = $tempText;
          }
        }
        else
        {
          $cID[] = $temp->id;
          $cNames[] = $temp->title;
          $cAvg[] = $r->rating;
          if($type == '2')
          {
            $cComments[] = array($r->comment);
          }
          else
          {
            $tempText = "<p>";
            if($admin)
            {
              $tempText .= $author->firstName." ".$author->lastName."<q>";
            }
            else
            {
              $tempText.="<q>";
            }

            $tempText .= "<q>".$r->comment."</q></p>";

            $cComments[] = array($tempText);
          }
        }
    }
    for($i = 0; $i<sizeof($cNames);$i++)
    {
      $dataout[]= array('lable' => $cNames[$i], 'rating' => $cAvg[$i]);
    }

    require_once("views/project/responsesProject.php");
  }
  //===================================================================================
  public function viewAssignmentProject()
  {

    $assignmentType = $_GET['type'];
    $assignmentid = $_GET['assignmentid'];
    $assignedUser=false;
    $userID = User::getID($_SESSION['token'])[1];
    $isadmin = User::checkAdmin($_SESSION['token'])[1];

    $projectid = $_GET['projectID'];
    $project = Project::id($projectid)[1];
    $assignment = Assignment::id($assignmentid)[1];
    $type=($assignment->type == 'submission' ? '1' : '3');
    $contents = Content::project($projectid)[1];
    $list = $project->list;
    $ids = array();

    $evaluated = Evaluate::getEvaluated(User::getID($_SESSION['token'])[1],$type , $projectid)[1];

    if($assignmentType == '3')
    {
      $targetUser = User::id($projectid)[1];
    }
    else
    {

      switch($project->isgroup)
      {
        case '0':

          foreach($list as $u)
          {
            $ids[] = $u->userID;
            if($u->userID === $userID)
              $assignedUser = true;
          }
          break;
        case '2':
          //Go through EventUsers(eventID)
          break;
        case '1':
          foreach($list as $u)
          {
            $ids[] = $u->id;
            if($u->id == $userID)
              $assignedUser = true;
          }
          break;
      }
    }


    require_once("views/project/viewAssignmentProject.php");
  }

  //===================================================================================
  public function viewEventProject()
  {
    $project;
    $list;
    $projectid = $_GET['projectID'];
    $eventid = $_GET['eventID'];
    $type = $_GET['type'];
    if($type == '1')
    {
      $project = Project::id($projectid)[1];
      $list = $project->list;
    }

    if($type == '2')
      $project = EventProject::id($projectid)[1];

    $ids = array();
    //echo sizeof($list);
    //echo $list;
    //echo "<br>".$projectid;

    require_once("views/project/viewEventProject.php");
  }
  //===================================================================================
  public function submit()
  {
    $message ="";
    $successful = false;
    $format = $_POST['format'];
      switch($format)
      {
        case 'link':
          $submission = Content::create($_POST['contentTitle'],$format,'0','NA',$_POST['data'],$_POST['projectID'],$_POST['author'])[1];
          $successful = true;
          break;
        case 'text':
          $submission = Content::create($_POST['contentTitle'],$format,'0','NA',$_POST['data'],$_POST['projectID'],$_POST['author'])[1];
          $successful = true;
          break;
        case 'image':
          $target_dir = "submissions/images/";
          $target_file = $target_dir . basename($_FILES["data"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = $_FILES["data"]["name"];
            if(move_uploaded_file($_FILES["data"]["tmp_name"], $target_file))
            {
              $successful = true;
              $submission = Content::create($_POST['contentTitle'],$format,'0',$target_dir.basename($_FILES["data"]["name"]),'NA',$_POST['projectID'],$_POST['author'])[1];
            }
          break;
        case 'file':
          $target_dir = "submissions/files/";
          $target_file = $target_dir . basename($_FILES["data"]["name"]);
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          $check = $_FILES["data"]["name"];
          if(move_uploaded_file($_FILES["data"]["tmp_name"], $target_file))
          {
            $submission = Content::create($_POST['contentTitle'],$format,'0',$target_dir.basename($_FILES["data"]["name"]),basename($_FILES["data"]["name"]),$_POST['projectID'],$_POST['author'])[1];
            $successful = true;
          }
          break;
      }
      if($successful)
         $message = $_POST['contentTitle']." has been successfully submitted.";
      else
      {
        $message = $_POST['contentTitle']." was not submitted.";
      }
        // echo "<script>window.close();</script>";
        echo $message;

  }
//===================================================================================
public function delete()
{

  $id = $_GET['id'];
  echo $id;
  Content::delete($id);
  ?>
  <script type='text/javascript'>
  self.close();
  </script>
  <?php
}

}
?>
