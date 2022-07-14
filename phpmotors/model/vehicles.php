

<?php
// Contain a function for inserting a new classification to the carclassifications table.
// Contain a function for inserting a new vehicle to the inventory table.


function regClassification($classificationName){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO carclassification (classificationName)
     VALUES (:classificationName)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;

}


function regVehicle($invMake, $invModel, $invDescription, $invImage, $invPrice, $invStock, $invColor, $classificationId){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invPrice, invStock, invColor, classificationId)
     VALUES (:invMake, :invModel, :invDescription, :invImage, :invPrice, :invStock, :invColor, :classificationId)';

    $stmt = $db->prepare($sql);


    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    //check
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);


    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;

}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }

function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}


//Update Vehicle


function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invPrice, $invStock, $invColor, $invId){
    $db = phpmotorsConnect();

    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';

    $stmt = $db->prepare($sql);


    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    //check
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);


    //Insert the data
    $stmt->execute();

    //ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    //Close the database interaction
    $stmt->closeCursor();

    //return the indication of success
    return $rowsChanged;

}

//Delete function
function deleteVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }

function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    //$sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    //$sql = 'SELECT * FROM images INNER JOIN inventory ON images.imgPath LIKE "%-tn%" = inventory.invThumbnail WHERE images.invid = inventory.invId AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName);';
    //NEED TO FIGURE OUT THIS SQL QUERY
    $sql = 'SELECT * FROM inventory JOIN images on images.invid = inventory.invId WHERE images.invid = inventory.invId AND images.imgPrimary = 1 AND images.imgPath LIKE "%-tn%" AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName);';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }


//    SELECT inventory.invThumbnail, images.imgPath
//    FROM images
//    INNER JOIN inventory ON images.imgPath LIKE '%tn';
   
// SELECT inventory.invThumbnail, images.imgPath
// FROM images
// JOIN inventory ON images.imgPath LIKE '%-tn%' = inventory.invThumbnail

   // Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}






?>