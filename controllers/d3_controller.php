<?php
class D3Controller
{
	public function classAnalytics()
	{
		//Need to get all users, assignments, projects, and evaluations done in this class along with the criteria for those evaluations
	    if(isset($_SESSION['token']))
	    {
	      $classID = $_GET['classID'];
	      $userList = User::klass($classID)[1];				//Gets users in class
	      // $groupList = 
		  $criteriaSetList = CriteriaSet::classCriteriaSet($classID)[1];
	    }

		//List of projects that were group projects that the person was involved with
		// $groupList = array();
		//List of people for peer evaluations
		// $peerList = array();

		// foreach ($userList as $key => $u)
		// {
		// 	$groupList[$u->firstName.$u->middleInitial.$u->lastName] = [];
		// 	$peerList[$u->firstName.$u->middleInitial.$u->lastName] = [];

		// 	$groups = Group::studentGroups($u->id)[1];
		// 	foreach ($groups as $key => $g)
		// 	{
		// 		$projects = Project::projectsByGroup($g)[1];
		// 		array_push($groupList[$u->firstName.$u->middleInitial.$u->lastName], $projects);
		// 	}

		// 	$peers = Project::peerEvaluationProjectsForUser($u->id)[1];
		// 	foreach ($peers as $key => $p)
		// 	{
		// 		array_push($peerList[$u->firstName.$u->middleInitial.$u->lastName], $p);
		// 	}
		// }



	    $status = 'user';                                   //checks for admin or user status
	    if(User::checkAdmin($_SESSION['token'])[1])
	        $status = 'admin';

	    require_once('views/analytics/classAnalytics.php');
	}
	//==============================================================
	public function projectAnalytics()
	{
		if(isset($_GET['assignmentID']) && isset($_GET['type']) && isset($_GET['classID']))
		{
			$assignmentID = $_GET['assignmentID'];
			$type = $_GET['type'];
			$classID = $_GET['classID'];
			$userType = $_GET['userType'];

			if($type == "submission")
			{
				$groupList = Group::groupsByAssignment($assignmentID)[1]; //X-axis data for bar graph
				$criteriaSetList = CriteriaSet::assignmentCriteriaSet($assignmentID)[1]; //Tab bars for the graph
				$evaluationsPerGroup = Evaluate::assignmentGroupEvaluations($assignmentID)[1];//Evaluations for a project sorted by groups

				// var_dump($groupList);
				// var_dump($criteriaSetList);
				// var_dump(Evaluate::averageRating($groupList[0][0], $criteriaSetList[0]->id)[1]);

				$evaluationAverages = array();

				foreach ($criteriaSetList as $key => $criteria)
				{
					foreach ($groupList as $key => $group)
					{
						$evaluationAverages[] = [
							"groupTitle" => $group[1],
							"groupID" => $group[0],
							"criteriaTitle" => $criteria->title,
							"criteriaID" => $criteria->id,
							"average" => Evaluate::averageRating($group[0], $criteria->id)[1],
							"users" => $group[2]
						];
					}
				}

				// var_dump($evaluationAverages);

				$fp = fopen('baseRatingsEvaluations.json', 'w');
				fwrite($fp, json_encode(array_values($evaluationsPerGroup)));
				fclose($fp);

				$fp = fopen('averageRatingsEvaluations.json', 'w');
				fwrite($fp, json_encode(array_values($evaluationAverages)));
				fclose($fp);
			}
			elseif ($type == "peer")
			{
				
			}
		}

		require_once('views/analytics/projectAnalytics.php');
	}
}
?>