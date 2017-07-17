<?php
Class Course {
  public $id;
  public $title;
  public $code;
  public $description;
  public $classes;
//=================================================================================== STRUCT
  public function __construct($id, $title, $code, $description, $classes) {
        $this->id = $id;
        $this->title = $title;
        $this->code = $code;
        $this->description = $description;
        $this->classes = $classes;

    }
  }
  ?>
