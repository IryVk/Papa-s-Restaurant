<?php

// start db connection
include("config/db_connect.php");

// include search code
include("includes/search.inc.php")

?>

<!DOCTYPE html>

<html>
<head>
    <title>Search Papa's</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria search"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar|Noto Sans">
    <link rel="stylesheet" href="styles/home_style.css" />
    <link rel="stylesheet" href="styles/menu_style.css" />
    <link rel="stylesheet" href="styles/nav_foot_style.css">
    <link rel="stylesheet" href="styles/sign_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <!-- This Part is the Head -->
    <div class="flex-container" id="head">
        <!-- Logo -->
        <?php include("templates/logo.php") ?>
        <div id="welcome">
            <h1>Papa's Search</h1>
        </div>
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- This part is the Nav Bar -->
    <?php include("templates/nav.php") ?>
    <!-- This is the sauce picture between divs -->
    <img src="images/sauce.png" id="sauce">
    <form action="search.php" method="POST">
        <div class="search">
            <h3 class="recent">Recent Searches: <a href="search.php?val=<?=$recent?>"><?=$recent?></a></h3>
            <input type="text" name="query" placeholder="What are you craving?">
            <div class="danger"><p><?=$errors_search ?></p></div>
        </div>
        <div class="search-bt">
            <button class="add-bt" type="submit" name="search">Search</button>
        </div> 
    </form>
    <?php if ($searched): ?>
        <?php if ($found): ?>
        <div class="flex-container just">
        <!-- Use a loop to display all pizzas in cards -->
            <?php foreach($products as $pizza){ ?>
                    <div class="card">
                        <div class="name">
                            <span><?php echo $pizza['name']; ?></span>
                        </div>
                        <div class="img">
                            <?php echo '<img src="data:image;base64,'.base64_encode($pizza['img']).'">' ?>
                        </div>
                        <hr>
                        <div class="ing">
                            <h3>Ingredients</h3>
                            <ul>
                            <?php $ings = explode(", ", $pizza['ingredients']);
                                foreach($ings as $ing){?>
                                    <li><?php echo $ing; ?></li>
                            <?php }?> 
                            </ul>    
                        </div>
                        <hr>
                        <div class="price">
                            <span><?php echo $pizza['price']; ?> L.E.</span>
                            <!-- hidden div to store real price -->
                            <span style="display: none;"><?php echo $pizza['price']; ?></span>
                        </div>
                        <div class="add">
                            <form action="?" method="POST">
                                <select name="size" id="size" required>
                                    <option value="s">S</option>
                                    <option value="m">M</option>
                                    <option value="l">L</option>
                                </select>
                                <input class="qtt" type="number" name="quantity" value="1" min="1" max="10" placeholder="Quantity" required>
                                <input type="hidden" name="product_id" value="<?=$pizza['id']?>">
                                <button class="add-bt" type="submit" name="add">Add to Cart</button>
                            </form>     
                        </div>
                    </div>
            <?php } ?>
        </div>
    <?php else:?>
        <h2 class="menu-opt" id="results">No pizzas found :c</h2>
    <?php endif ?>
    <?php endif ?>
    <script src="scripts/menu_script.js"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
    <?php unset($products) ?>
</body>
</html>