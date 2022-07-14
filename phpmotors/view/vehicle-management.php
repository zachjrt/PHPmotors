<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/index.php');
 exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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
        <h1>Vehicle Management</h1>

        <ul>
        <li><a href="/phpmotors/vehicles/index.php?action=vehicle">Register new Vehicle</a> </li>
        <li><a href="/phpmotors/vehicles/index.php?action=classificationPage">Register new Classification of Vehicle</a> </li>
        </ul>

        <?php
            if (isset($message)) {
            echo $message;
            }
            ?>

        <h4>Vehicles by Classification</h4>
        <h6>Choose a classification to see those vehicles.</h6>
        <?php
        echo $classificationList;
        ?>
         

        <table id="inventoryDisplay"></table>
        
    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    <script src="../js/inventory.js"></script>
    </div>
    
</body>



</html>
<?php unset($_SESSION['message']); ?>