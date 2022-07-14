<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" type="text/css" rel="stylesheet" media="screen">
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
        
        <section id="section1">
        <h1>Welcome to PHP Motors</h1>
        <div>
            <h2>DMC Delorean</h2>
            <div class="deloreanText">3 Cup holders <br>Superman doors <br>Fuzzy dice!</div>
        </div>
        <img class="deloreanPic" src="/phpmotors/images/vehicles/delorean.jpg" alt="Delorean Car">
        <div class="ownTodayWrapper">
            <button class="ownToday"> <img src="/phpmotors/images/site/own_today.png" alt="Own today"></button>
        </div>
        </section>
        <section id="section2">
        <h1>DMC Delorean Reviews</h1>
        <div class="bulletListWrapper">
            <ul>
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marty McFly!" (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>

            </ul>
        </div>
        </section>
        <section id="section3">
        <h1>Delorean Upgrades</h1>

        <div class="upgradeSection">
            <div id="row1">
                <div>
                    <div class="upgradeBox">
                        <img class="upgradePic" src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux capacitor">
                    </div>
                    <a href="#">Flux Capacitor</a>
                </div>
                <div>
                    <div class="upgradeBox">
                        <img class="upgradePic" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper sticker">
                    </div>
                    <a href="#">Bumper Sticker</a>
                </div>
            </div>
            <div id="row2">
                <div>
                    <div class="upgradeBox">
                        <img class="upgradePic" src="/phpmotors/images/upgrades/flame.jpg" alt="Flame upgrade">
                    </div>
                    <a href="#">Flame Decals</a>
                </div>
                <div>
                    <div class="upgradeBox">
                        <img class="upgradePic" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Cap">
                    </div>
                    <a href="#">Hub Caps</a>
                </div>
            </div>
        </div>
        </section>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </div>
    
</body>



</html>