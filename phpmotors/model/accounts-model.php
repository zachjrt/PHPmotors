<?php

/*
*Accounts Model
*/

//Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
    $db = phpmotorsConnect();

    //the SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
     VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the php motors connection
    $stmt = $db->prepare($sql);

    //The next four lines replace the placeholders int he SQL
    //Statement with the actual values in the variable
    //and tells the database the type of data it is

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;

}

//Email duplicate check

function emailDuplicateCheck($clientEmail){
        $db =  phpmotorsConnect();


        $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';


        $stmt = $db->prepare($sql);


        $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);


        $stmt->execute();


        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);


        $stmt->closeCursor();

        
        if(empty($matchEmail)){
         return 0;
        } else {
         return 1;
        }
}

function getClient($clientEmail){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId){

    $db = phpmotorsConnect();

    //the SQL statement
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
    // Create the prepared statement using the php motors connection
    $stmt = $db->prepare($sql);

    //The next four lines replace the placeholders int he SQL
    //Statement with the actual values in the variable
    //and tells the database the type of data it is

    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    

    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;
}


function getClientId($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}



function updatePassword($clientPassword, $clientId){

    $db = phpmotorsConnect();

    //the SQL statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
    // Create the prepared statement using the php motors connection
    $stmt = $db->prepare($sql);

    //The next four lines replace the placeholders int he SQL
    //Statement with the actual values in the variable
    //and tells the database the type of data it is

    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    

    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;
}

?>