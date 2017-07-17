<?php
class ClassObject {
  public $id;
  public $title;
  public $courseid;
  public $sessionTime;
  public $description;
  public $location;
//=================================================================================== STRUCT
  public function __construct($id, $title,$courseid,$sessiontime,$description,$location) {
        $this->id = $id;
        $this->title = $title;
        $this->couresid = $courseid;
        $this->sessionTime = $sessiontime;
        $this->description = $description;
        $this->location = $location;

    }
  }
  ?>
