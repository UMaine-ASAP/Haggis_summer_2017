<?php
Class Course {
  public $id;
  public $title;
  public $code;
  public $description;
//=================================================================================== STRUCT
  public function __construct($id, $title, $code, $description) {
        $this->id = $id;
        $this->title = $title;
        $this->code = $code;
        $this->description = $description;

    }
  }
  ?>
