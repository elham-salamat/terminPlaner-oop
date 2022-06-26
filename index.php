<?php
require_once("php/functions/pathgain.php");
require_once("php/objects/navigation.php");
require_once("php/objects/website.php");
require_once("php/objects/user.php");
require_once("php/objects/appointment.php");
require_once("php/objects/appointmentlist.php");
require_once("php/objects/calendar.php");
require_once("php/objects/pdo/databank.php");
require_once("php/objects/manageappointment.php");


pathCorrection();
session_start();


// function autoLoader($requiredFiles)
// {
    
//     require("/php/objects/".$requiredFiles.".php");
//     require("/php/objects/pdo".$requiredFiles.".php");
//     require("/pages/".$requiredFiles.".php");
// }


// spl_autoload_register("autoLoader");
// $secondLevelSelection = pathCorrection();
// echo BASIC_PATH;
// echo "<br>";
// print_r($secondLevelSelection);
// die();

// echo $_SESSION["userId"];
// die();
$navigation = new navigation(); 

