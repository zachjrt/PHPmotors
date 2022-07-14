<header>
<div id="header">
    <img src="/phpmotors/images/site/logo.png" alt="PHP motors logo">
    
    <?php
        if(isset($_SESSION['loggedin'])){
            
            echo "<div id='myAccount'>"."<a href='/phpmotors/accounts/index.php
            '>".$_SESSION['clientData']['clientFirstname']."</a>"." | <a href='/phpmotors/accounts/index.php?action=logout'>Log out</a></div>";
        }
        else{
            echo "<div id='myAccount'><a href='/phpmotors/accounts/index.php?action=login'>My Account</a></div>";
        }
    ?>
    
</div>
</header>