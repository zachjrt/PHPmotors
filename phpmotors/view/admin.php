<?php

if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/index.php');
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
        <h1><?php
        echo $_SESSION['clientData']['clientFirstname'];
        echo " ";
        echo $_SESSION['clientData']['clientLastname'];
        ?></h1>

            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>

        <p>You are logged in</p>
        <ul>
            <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
            <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
        </ul>

        <h4>Account Management</h4>
        <p>Use this link to update account information</p>
        <p><a href='/phpmotors/accounts/index.php?action=clientUpdate'>Update account information</a></p>

        <?php
                if($_SESSION['clientData']['clientLevel'] > 1){
                    echo "<h4>Inventory Management</h4><p>Use this link to manage the inventory</p><p><a href='/phpmotors/vehicles/index.php'>Add Vehicles</a></p>";
                }
        ?>



<?php if(isset($clientReview)){
 echo $clientReview;

} ?>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
</body>



</html>