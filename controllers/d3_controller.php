<?php
class D3Controller
{
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
							"average" => Evaluate::averageGroupRating($group[0], $criteria->id)[1],
							"users" => $group[2]
						];
					}
				}

				$fp = fopen('baseRatingsEvaluationsGroup.json', 'w');
				fwrite($fp, json_encode(array_values($evaluationsPerGroup)));
				fclose($fp);

				$fp = fopen('averageRatingsEvaluationsGroup.json', 'w');
				fwrite($fp, json_encode(array_values($evaluationAverages)));
				fclose($fp);
			}
			elseif ($type == "peer")
			{
				//Get students for assignment with evaluations they have received for a criteria
				$peerEvaluations = Evaluate::assignmentPeerEvaluations($assignmentID)[1];
				$criteriaSetList = CriteriaSet::assignmentCriteriaSet($assignmentID)[1];
				$studentsInClass = Klass::getUsers($classID)[1];

				$evaluationAverages = array();

				foreach ($criteriaSetList as $key => $criteria)
				{
					foreach ($studentsInClass as $key => $student)
					{
						$evaluationAverages[] = [
							"targetName" => $student['first']." ".$student['middle']." ".$student['last'],
							"targetID" => $student['id'],
							"criteriaTitle" => $criteria->title,
							"criteriaID" => $criteria->id,
							"average" => Evaluate::averagePeerRating($criteria->id, $assignmentID, $student['id'])[1]
						];
					}
				}

				$fp = fopen('baseRatingsEvaluationsPeer.json', 'w');
				fwrite($fp, json_encode(array_values($peerEvaluations)));
				fclose($fp);

				$fp = fopen('averageRatingsEvaluationsPeer.json', 'w');
				fwrite($fp, json_encode(array_values($evaluationAverages)));
				fclose($fp);
			}
		}

		require_once('views/analytics/projectAnalytics.php');
	}
}
?>