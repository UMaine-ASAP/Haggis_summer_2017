<?php
Class Group {
  public $studentGroupID;
  public $projectID;
  public $userIDs;
//=================================================================================== STRUCT
  public function __construct($studentGroupID, $projectID, $userIDs) {
        $this->studentGroupID = $studentGroupID;
        $this->projectID = $projectID;
        $this->userIDs = $userIDs;

    }
  }
  ?>
