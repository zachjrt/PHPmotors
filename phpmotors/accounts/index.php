<?php

//Accounts controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

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
    case 'register':
      
      //filter and store the data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      //Email check
      $existingEmail = emailDuplicateCheck($clientEmail);

      if($existingEmail){
        $message = '<p class="notice">That email address exists already. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
       }


      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
        $message = '<p class="center">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit;
      }
      
      //send the data to the model if no errors exist
      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      if($regOutcome === 1){
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
        include '../view/login.php';
        exit;
      } else{
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        header('Location: /phpmotors/accounts/?action=login');
        //include '../view/registration.php';
        exit;
      }
      break;

    case 'registration':
    
      include '../view/registration.php';
          
      break;
        
    case 'login':

      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      
      if (empty($clientEmail) || empty($checkPassword)) {
        $message = '<p class="center">Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit;
      } else{
        $message = '<p class="center">Thanks for logging in</p>';
        include '../view/login.php';
        exit;
      }

      case 'clientUpdate':

        include '../view/client-update.php';
        
      break;


      case 'updateAccount':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        //Check if email is different than session email, if so is it already registered?
        if ($clientEmail != $_SESSION['clientData']['clientEmail']){
            $existingEmail = emailDuplicateCheck($clientEmail);
       
          if($existingEmail){
            $message = '<p class="notice">That email address exists already. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
          }
        }
        
        //check for errors and return
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
          $message = '<p class="center">Please provide information for all empty form fields.</p>';
          include '../view/client-update.php';
          exit;
        }

        //Update with appropriate function
        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        //Success or fail
        if($updateOutcome === 1){
          setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
          $_SESSION['message'] = "Thanks for Updating your account $clientFirstname. ";
          $clientData = getClientId($clientId);
          $_SESSION['clientData'] = $clientData;
         
          include '../view/admin.php';
          exit;
        } else{
          $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
          //header('Location: /phpmotors/view/admin.php');
          include '../view/admin.php';
          exit;
        }


       

        include '../view/client-update.php';
      break;


        //Password change
      case 'updatePassword':
        //obtain and filter
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $checkPassword = checkPassword($clientPassword);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        //Check empty
        if ($checkPassword == 0) {
          $_SESSION['message'] = '<p class="center">Please follow password guidelines.</p>';
      
          include '../view/client-update.php';
          exit;
        }

        

        //Hash
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        //Update password
        $updateOutcome = updatePassword($hashedPassword, $clientId);

        //Success or fail
        if($updateOutcome === 1){
          $_SESSION['message'] = "Thanks for Updating your password ".$_SESSION['clientData']['clientFirstname'];
          
          
          include '../view/admin.php';
          exit;
        } else{
          $message = "<p>Sorry ".$_SESSION['clientData']['clientFirstname'].", but the password update failed. Please try again.</p>";
          header('Location: /phpmotors/view/admin.php');
          //include '../view/registration.php';
          exit;
        }


        include '../view/client-update.php';
      break;
      
      case 'Login':
    
          $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
          $clientEmail = checkEmail($clientEmail);
          $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $passwordCheck = checkPassword($clientPassword);

          // Run basic checks, return if errors
          if (empty($clientEmail) || empty($passwordCheck)) {
          $message = '<p class="notice">Please provide a valid email address and password.</p>';
          include '../view/login.php';
          exit;
          }
            
          // A valid password exists, proceed with the login process
          // Query the client data based on the email address
          $clientData = getClient($clientEmail);
          $_SESSION['clientData'] = $clientData;
          // Compare the password just submitted against
          // the hashed password for the matching client
          $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
          // If the hashes don't match create an error
          // and return to the login view
          if(!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
          }
          // A valid user exists, log them in
          $_SESSION['loggedin'] = TRUE;
          // Remove the password from the array
          // the array_pop function removes the last
          // element from an array
          array_pop($clientData);
          // Store the array into the session
          $_SESSION['clientData'] = $clientData;
          // Send them to the admin view
          include '../view/admin.php';
          exit;
            
        break;


      include '../view/login.php';
      break;

    case 'logout':

        
        unset($_SESSION['clientData']);
        session_destroy();
        header('Location: /phpmotors/index.php');
       
        break;

    default:
    include '../view/admin.php';
    break;
    
  }



?>