
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
        <h1>Register</h1>


        <div class="inputForm">
            <?php
            if (isset($message)) {
            echo $message;
            }
            ?>
            <form method="post" action="/phpmotors/accounts/index.php">
            <label for="clientFirstname">First Name</label>
            <input type="text" name="clientFirstname" id="fname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>

            <label for="clientLastname">Last Name</label>
            <input type="text" name="clientLastname" id="lname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>

            <label for="clientEmail">Email</label>
            <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>

            <br>
            <span>Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>

            <label for="clientPassword">Password</label>
            <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

            <br>
            
            <input class="submitButton" type="submit" name="submit" id="regbtn" value="Register">
            <input type="hidden" name="action" value="register">
            </form>
        </div>
        

        

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
</body>



</html>