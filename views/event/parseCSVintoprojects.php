<?php
if(true)                                  //For debugging only
{                                         //    Set false to remove all error
  ini_set('display_errors', 1);           //    reporting.
  ini_set('display_startup_errors',1);
  error_reporting(E_ALL);
}
require_once('../../models/eventProject.php');
require_once('../../connection.php');
$csvFile = file('input.csv');
   $data = [];
   foreach ($csvFile as $line) {
       $data[] = str_getcsv($line);
   }

   echo sizeof($data)."<hr>";

   //sort($data);
   foreach($data as $d)
   {
     $CUGRnumber = $d[18];
     $title = $d[1];
     $type = $d[5];
     $subType = $d[6];
     $speakers = $d[9];
     $tags = $d[22];
     $description="";
     if(intval($CUGRnumber) > 0)
     {
      echo $CUGRnumber." - ". $title."<br>";

      $description =  "Speakers: ".$speakers."
      Catagory: ".$type."  Sub-type: ".$subType."
      Tags: ".$tags;
      echo nl2br($description)."<hr>";
    }

    $tempID = EventProject::create($title, $description, " ", -2, $CUGRnumber)[1];
    EventProject::associatewithevent($tempID, 2)[1];
   }

   ?>
