<?php
if(!isset($vehicle)){
    header('Location: /phpmotors/vehicles/index.php?action=vehicleView&vehicleId='.$vehicleId);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" type="text/css" rel="stylesheet" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Supermercado+One&display=swap" rel="stylesheet">
    <title><?php echo $vehicle['invMake']."|".$vehicle['invModel']; ?> </title>
</head>
<body>
    <div id="contentWrapper">

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>


    <nav  id="mainNavigation">
    <?php
        echo $navList;
        ?>
    </nav>

    <main>
        <h1><?php echo $vehicle['invMake']." ".$vehicle['invModel']; ?></h1>
        
        <?php if(isset($message)){
        echo $message; }
        ?>

<div id="detailContainer">
<?php if(isset($vehicleDisplay)){
 echo $thumbnailDisplay;
 echo $vehicleDisplay;
} ?>
</div>


<hr>
<h2>Customer Reviews</h2>


<?php
if(!isset($_SESSION['loggedin'])){
    echo "<p>You must <a href='/phpmotors/accounts/index.php?action=login'>login</a> to write a review</p>";
   }

else{
    echo '<div id="add-review">
    <h2>Review the '.$vehicle["invMake"].' '.$vehicle["invModel"].'</h2>
    <form method="post" action="/phpmotors/reviews/index.php">

    <label for="screenName">Screen Name:</label><br>
    <input name="screenName" id="screenName" type="text" readonly value="'.substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname'].'">
     
 
    <br>

    <label for="review">Review:</label><br>
    <textarea id="review" name="review" rows="4" cols="50" placeholder="Type review here" required>
    </textarea><br>

    <input class="submitButton" type="submit" value="Submit Review">
    <input type="hidden" name="action" value="add-review">
    <input type="hidden" name="clientId" value="'.$_SESSION['clientData']['clientId'].'">
    <input type="hidden" name="invId" value="'.$vehicle["invId"].'">
    
   
    </form>
</div>';
    
}
?>

<div id="reviews">
<?php if(isset($vehicleReviewList)){
 echo $vehicleReviewList;

} ?>
</div>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
<script src="../js/vehicleView.js"></script>
</body>





</html>