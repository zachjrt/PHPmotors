<?php

//Main controller

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
// Get functions
require_once 'library/functions.php';


// Create or access a Session
session_start();

// Get the array of classifications
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = navListBuild($classifications);



$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


 if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }


      switch ($action) {
        case 'template':
        include 'view/template.php';       
        break;

        //case '':
        //include 'view/template.php';       
        //break;

        default:
        include 'view/home.php';
      
        
        }
     
   



?>