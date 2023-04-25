<?php


?>

<!DOCTYPE html>

<html>
<head>
    <title>Papa's Restaurant</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar|Noto Sans">
    <link rel="stylesheet" href="styles/home_style.css">
    <link rel="stylesheet" href="styles/sign_style.css">
    <link rel="stylesheet" href="styles/nav_foot_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="flex-container" id="head">
        <video id="background-video" autoplay muted loop id="myVideo">
            <source src="images/cook.mp4" type="video/mp4">
          </video>
        <!-- Logo -->
        <?php include("templates/logo.php") ?>
        <div id="welcome">
            <h1>Welcome to Papa's Pizzeria!</h1>
        </div> 
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <?php include("templates/nav.php") ?>
    <div class="container odd">
        <img src="images/cheese.png" id="cheese">
        <div class="flex-container" id="par">
            <div id="intro">
                <p>Satisfy your cravings with the best pizza in Egypt!</p>
                <p><a href="menu.php" class="button" id="order">Order now <i class="fa-solid fa-arrow-right"></i></a>
                <a href="#" class="button" id="track">Track order</a></p>
            </div>
            <div ><img id="intro_img" src="images/pizza.jpg"></div>
        </div>
    </div>
    <div class="container even" style="height: 4000px;">
        <div>
            <img src="images/sauce.png" id="sauce">
            <h1 id="menu" class="reveal">Our Menu</h1>
        </div>
    </div>
    <?php include("templates/footer.php"); ?>

</body>
</html>