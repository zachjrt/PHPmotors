<?php

//Main controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicle model for use as needed
require_once '../model/vehicles.php';
// Get functions
require_once '../library/functions.php';
require_once '../model/uploads-model.php';
// Create or access a Session
// Get functions
require_once '../model/reviews-model.php';
session_start();


###

// Create the $navList variable to build the dynamic menu from an array of classifications obtained by calling the function in the phpmotors model, as in previous controllers.
$classifications = getClassifications();


// Build a navigation bar using the $classifications array
$navList = navListBuild($classifications);





$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }





 switch ($action) {

    case 'vehicle':
    include '../view/add-vehicle.php';
    exit;
    case 'addVehicle':
          //filter and store the data
          //$invMake, $invModel, $invDescription, $invImage, $invPrice, $invStock, $invColor, $classificationId)
          $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $invImage = "/phpmotors/images/no-image.png";
          $invThumbnail = "/phpmotors/images/no-image.png";
          $invPrice = trim(filter_input(INPUT_POST, 'invPrice'), FILTER_SANITIZE_NUMBER_INT);
          $invStock = trim(filter_input(INPUT_POST, 'invStock'), FILTER_SANITIZE_NUMBER_INT);
          $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));


          if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
          $message = '<p class="center">Please provide information for all empty form fields.</p>';
          include '../view/add-vehicle.php';
          exit;
        }
        
        //send the data to the model is no errors exist
        $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invPrice, $invStock, $invColor, $classificationId);

        if($regOutcome === 1){
          $message = "<p>Thanks for registering the new Vehicle of $invMake.</p>";
          include '../view/add-vehicle.php';
          exit;
        } else{
          $message = "<p>Sorry but the registration failed. Please try again.</p>";
          include '../view/add-vehicle.php';
          exit;
        }
          break;

    case 'classificationPage':
          include '../view/add-classification.php';
          exit;

    

    case 'addClassification':
          //filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if(empty($classificationName)){
          $message = '<p class="center">Please provide information for all empty form fields.</p>';
          include '../view/add-classification.php';
          exit;
        }
        
        //send the data to the model is no errors exist
        $regOutcome = regClassification($classificationName);

        if($regOutcome === 1){
          $message = "";
          include '../view/vehicle-management.php';
          exit;
        } else{
          $message = "<p>Sorry but the registration failed. Please try again.</p>";
          include '../view/add-classification.php';
          exit;
        }
        break;

    case 'updateVehicle':
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invImage = "/phpmotors/images/no-image.png";
      $invThumbnail = "/phpmotors/images/no-image.png";
      $invPrice = trim(filter_input(INPUT_POST, 'invPrice'), FILTER_SANITIZE_NUMBER_INT);
      $invStock = trim(filter_input(INPUT_POST, 'invStock'), FILTER_SANITIZE_NUMBER_INT);
      $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      
      if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
        $message = '<p>Please complete all information for the updated item! Double check the classification of the item.</p>';
        include '../view/vehicle-update.php';
        exit;
      }
      $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invPrice, $invStock, $invColor, $invId);
      if ($updateResult) {
        $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
       
      } else {
        $message = "<p>Error. The vehicle was not updated.</p>";
        include '../view/vehicle-update.php';
        exit;
      }
      break;

    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
          $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /phpmotors/vehicles/');
          exit;
        } else {
          $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
          $_SESSION['message'] = $message;
          header('location: /phpmotors/vehicles/');
          exit;
        }
    break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
          }
          include '../view/vehicle-delete.php';
          exit;
    break;

    case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
    break;
   
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
    break;     



  case 'classification':
      $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $vehicles = getVehiclesByClassification($classificationName);
      if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
      } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
      }

      //echo $vehicleDisplay;
      //exit;
      include '../view/classification.php';
  break;


  
  case 'vehicleView':
    
    $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
    $vehicle = getInvItemInfo($vehicleId);
    $thumbnails = obtainThumbnails($vehicleId);
    $invReview = getInventoryReviews($vehicleId);
    $screenName =  substr($_SESSION['clientData']['clientFirstname'], 1);
    $screenName .= $_SESSION['clientData']['clientLastname'];


    //echo $thumbnails[3];
    //exit;
    if(!isset($vehicle )){
      $message = "<p class='notice'>Sorry, Vehicle ID number $vehicleId could not be found.</p>";
    } else {
      $vehicleReviewList = buildReview($invReview);
      $vehicleDisplay = buildSingleVehicle($vehicle);
      $thumbnailDisplay = buildThumbnails($thumbnails);
    }

    
    include '../view/vehicle-detail.php';
  break;


    default:

        $classificationList = buildClassificationList($classifications);


        include '../view/vehicle-management.php';
    break;
   
   }

     
   



?>