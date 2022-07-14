
<?php
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
        <h1>Manage Account</h1>

        <h3>Update Account</h3>
        <div class="inputForm">
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
            <label for="fname">First Name</label>
            <input type="text" name="clientFirstname" id="fname" value="<?php echo $_SESSION['clientData']['clientFirstname']; ?>" required>

            <label for="lname">Last Name</label>
            <input type="text" name="clientLastname" id="lname" value="<?php echo $_SESSION['clientData']['clientLastname']; ?>" required>

            <label for="email">Email</label>
            <input type="email" name="clientEmail" id="email" value="<?php echo $_SESSION['clientData']['clientEmail']; ?>" required><br>

            <input class="submitButton" type="submit" name="submit" id="regbtn" value="Update Info">
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'] ?>"> 
            
            </form>



            <h3>Update Password</h3>
            <form method="post" action="/phpmotors/accounts/index.php">
            
            <span>Entering a password will change the current password</span><br>
            <span>Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

            <br>
            
            <input class="submitButton" type="submit" name="submit" id="regbtn2" value="Update Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'] ?>"> 


           
            
            </form>
        </div>
        

        

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
</body>



</html>