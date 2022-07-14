<?php
//Reviews controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get functions
require_once '../library/functions.php';
// Get functions
require_once '../model/reviews-model.php';



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




 switch ($action) {
    case 'add-review':
         //filter and store the data
         $vehicleId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
         $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
         $reviewText = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
         
  
         if(empty($vehicleId) || empty($clientId) || empty($reviewText)){
         $message = '<p class="center">Please provide information for all empty form fields.vehicle'.$vehicleId.' client'.$clientId.' Review'.$reviewText.'</p>';
         
       }
         //send the data to the model is no errors exist
         $addOutcome =  regReview($reviewText, $vehicleId, $clientId);
 
         if($addOutcome === 1){
           $message = "";
           include '../view/vehicle-detail.php';
           exit;
         } else{
           $message = "<p>Sorry but the review submission failed. Please try again.</p>";
           include '../view/vehicle-detail.php';
           exit;
         }

         include '../view/vehicle-detail.php';

      break;

    case 'update-view':
    
      include '../view/vehicle-detail.php';
          
      break;
        
    case 'update-review':
      $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
      $reviewText = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      if(empty($reviewId ) || empty($reviewText)){
        $message = '<p class="center">Please provide information for all empty form fields. review'.$reviewText.' review ID'.$reviewID.'</p>';
      }

      $upOutcome =  updateReview($reviewText, $vehicleId, $clientId);
 
      if($upOutcome === 1){
        $message = "Update successful";
        include '../view/admin.php';
        exit;
      } else{
        $message = "<p>Sorry but the review update failed. Please try again.</p>";
        include '../view/admin.php';
        exit;
      }

        include '../view/admin.php';
        
      break;


    case 'delete-review':
        
      $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);

        include '../view/vehicle-detail.php';

         
      //send the data to the model is no errors exist
      $delOutcome =  deleteReview($reviewId);

      if($delOutcome === 1){
        $message = "The review was deleted succesfully";
        include '../view/vehicle-detail.php';
        exit;
      } else{
        $message = "<p>The review was not deleted.</p>";
        include '../view/vehicle-detail.php';
        exit;
      }
      break;


    case 'delete-view':
       

        include '../view/vehicle-detail.php';
      break;
          

    default:

    echo 'hello';
    $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invReview = getInventoryReviews($vehicleId);
    $screenName =  substr($_SESSION['clientData']['clientFirstname'], 1);
    $screenName .= $_SESSION['clientData']['clientLastname'];

    if(!isset($_SESSION['loggedin'])){
        header('Location: /phpmotors/index.php');
       }

    else{
      $vehicleReviewList = buildReview($invReview);
        include '../view/admin.php';
    }
    
    break;
    
  }











?>