<?php



// o Update a specific review 
function updateReview($reviewId, $reviewText){
    //Needs review text and review id parameters
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText, reviewDate = CURRENT_TIMESTAMP WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $rowsChanged;
}




// o Delete a specific review 
function deleteReview($reviewId){
    //specific reviewId parameter
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $rowsChanged;
}


// o Get reviews for a specific inventory item 
function getInventoryReviews($InvId){
    //$vehicleReview for a specific client;
    $db = phpmotorsConnect();
    //mod this
    $sql = 'SELECT reviews.reviewText, reviews.reviewDate, reviews.invId, reviews.clientId, clients.clientFirstname, clients.clientLastname FROM reviews JOIN clients ON reviews.clientId = clients.clientId WHERE reviews.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':InvId', $InvId, PDO::PARAM_STR);
    $stmt->execute();
    $inventoryReviews = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventoryReviews;
}



// o Get reviews written by a specific client

function getClientReviews($clientId){
    //$vehicleReview for a specific client;
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invModel, inventory.invMake, reviewId, reviewDate From reviews Join inventory ON reviews.invID = inventory.invId WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientsReviews = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientsReviews;
}


// o Get a specific review 
function getSpecificReview($reviewId){

}


// o Get reviews for a specific inventory item 
function getReviewsInvItem($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfoReview = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfoReview;
}


// o Insert a review 
function regReview($reviewText, $invId, $clientId){
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
     VALUES (:reviewText, :invId, :clientId)';

    $stmt = $db->prepare($sql);


    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);



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