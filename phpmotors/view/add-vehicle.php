<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/index.php');
 exit;
}
?><?php
$classificationList = '<select name="classificationId" id="classification">';
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'";
  if(isset($classificationId)){
    if($classification['classificationId'] == $classificationId){
        $classificationList .= ' selected ';
    }
  }
  $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" type="text/css" rel="stylesheet" media="screen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis&family=Supermercado+One&display=swap" rel="stylesheet">
    <title>PHP Motors</title>
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
        <h1>Add Vehicle</h1>

        <div class="inputForm">
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/vehicles/index.php">

        
            <label for="make">Make</label>
            <input type="text" name="invMake" id="make" <?php if(isset($invMake)){echo "value='$invMake'";} ?> required>

            <label for="model">Model</label>
            <input type="text" name="invModel" id="model" <?php if(isset($invModel)){echo "value='$invModel'";} ?> required>

            <label for="description">Description</label>
            <input type="text" name="invDescription" id="description" required <?php if(isset($invDescription)){echo "value='$invDescription'";} ?>>

            <label for="image">Image</label>
            <input type="file" name="invImage" id="image" required <?php if(isset($invImage)){echo "value='$invImage'";} ?>>

            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="invThumbnail" id="thumbnail" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?>>

            <label for="price">Price</label>
            <input type="text" name="invPrice" id="price" required <?php if(isset($invPrice)){echo "value='$invPrice'";} ?>>

            <label for="stock">Stock</label>
            <input type="text" name="invStock" id="stock" required <?php if(isset($invStock)){echo "value='$invStock'";} ?>>

            <label for="color">Color</label>
            <input type="text" name="invColor" id="color" required <?php if(isset($invColor)){echo "value='$invColor'";} ?>>

            <label for="classification">Classification</label>
            <?php
            echo $classificationList;
            ?>


            <br>
            
            <input class="submitButton" type="submit" name="submit" id="vehbtn" value="Add Vehicle">
            <input type="hidden" name="action" value="addVehicle">
            </form>
        </div>
    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
</body>



</html>