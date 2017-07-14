<?php
Class User {
  public $id;
  public $firstName;
  public $lastName;
  public $email;
//=================================================================================== STRUCT
  public function __construct($id, $firstName, $middleInitial, $lastName, $email, $usertype) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->middleInitial = $middleInitial;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->usertype = $usertype;
    }
  }
  ?>
