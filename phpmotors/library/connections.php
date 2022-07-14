<?php
/*
*Proxy Connection to the phpmotors database
*/

function phpmotorsConnect(){
 $server = '127.0.0.1:4306';
 $dbname= 'phpmotors';
 $username = 'iClient';
 $password = ')VXSfOpmQ/BNlSs*'; 
 $dsn = "mysql:host=$server;dbname=$dbname";
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 // Create the actual connection object and assign it to a variable
 try {
    $link = new PDO($dsn, $username, $password, $options);
    if(is_object($link)){
    return $link;
    }
    
   } catch(PDOException $e) {
    header('Location: /phpmotors/view/500.php');
    exit;
   }
}

phpmotorsConnect();

?>