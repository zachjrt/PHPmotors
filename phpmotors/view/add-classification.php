<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/index.php');
 exit;
}
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
        <h1>Add Classification</h1>


        <div class="inputForm">
            <?php
            if (isset($message)) {
            echo $message;
            }
            if (isset($classificationList)) { 
                echo '<h2>Vehicles By Classification</h2>'; 
                echo '<p>Choose a classification to see those vehicles</p>'; 
                echo $classificationList; 
               }
            ?>

            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>

            

            <form method="post" action="/phpmotors/vehicles/index.php">


            <label for="classification">New Classification</label>
            <input type="text" name="classificationName" id="classification" required maxlength="30" required <?php if(isset($classificationName)){echo "value='$classificationName'";} ?>><br>
            <br>
            <span>Classifications must be under 30 characters long</span> <br>
          
            <input class="submitButton" type="submit" name="submit" id="classbtn" value="Add Classification">
            <input type="hidden" name="action" value="addClassification">
            </form>
        </div>



    

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    <script src="../js/inventory.js"></script>
</body>



</html>