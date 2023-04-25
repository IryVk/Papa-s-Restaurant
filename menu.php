<?php

// Include the db connection file
include("config/db_connect.php");

// include menu functions
include("templates/menu.inc.php");


    
mysqli_close($conn);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Papa's Menu</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria menu"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar|Noto Sans">
    <link rel="stylesheet" href="styles/home_style.css" />
    <link rel="stylesheet" href="styles/menu_style.css" />
    <link rel="stylesheet" href="styles/nav_foot_style.css">
    <link rel="stylesheet" href="styles/sign_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
</head>
<body>
    <!-- This Part is the Head -->
    <div class="flex-container" id="head">
        <!-- Logo -->
        <?php include("templates/logo.php") ?>
        <div id="welcome">
            <h1>Papa's Menu</h1>
        </div>
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- This part is the Nav Bar -->
    <?php include("templates/nav.php") ?>
    <!-- This is the sauce picture between divs -->
    <img src="images/sauce.png" id="sauce">
    <!-- This is the pizzas menu -->
    <h2 class="menu-opt" id="pizzas"><i class="fa-sharp fa-solid fa-pizza-slice" style="color: rgb(130, 2, 0);"></i> Pizzas</h2>
    <div class="flex-container just">
        <!-- Use a loop to display all pizzas in cards -->
        <?php foreach($pizzas as $pizza){ ?>
                <div class="card">
                    <div class="name">
                        <span><i class="fa-sharp fa-solid fa-pizza-slice" style="color: #f7b21f;"></i> <?php echo ''.$pizza['name']; ?></span>
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
                        <form action="menu.php" method="POST">
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
    <!-- This is the appetizers menu -->
    <h2 class="menu-opt" id="appt">Appetizers</h2>
        <div class="flex-container just">
            <?php foreach($sides as $side){ ?>
                <div class="card">
                    <div class="name">
                        <span><?php echo ''.str_replace("Side ", "", $side['name']); ?></span>
                    </div>
                    <div class="img">
                        <?php echo '<img src="data:image;base64,'.base64_encode($side['img']).'">' ?>
                    </div>
                    <hr>
                    <div class="ing">
                        <h3>Ingredients</h3>
                        <ul>
                        <?php $ings = explode(", ", $side['ingredients']);
                            foreach($ings as $ing){?>
                                <li><?php echo $ing; ?></li>
                        <?php }?> 
                        </ul>    
                    </div>
                    <hr>
                    <div class="price">
                        <span><?php echo $side['price']; ?> L.E.</span>
                        <!-- hidden div to store price -->
                        <span style="display: none;"><?php echo $side['price']; ?></span>
                    </div>
                    <div class="add">
                        <form action="menu.php" method="POST">
                            <select name="size" id="size" required>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                            </select>
                            <input class="qtt" type="number" name="quantity" value="1" min="1" max="10" placeholder="Quantity" required>
                            <input type="hidden" name="product_id" value="<?=$side['id']?>">
                            <button class="add-bt" type="submit" name="add">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- This is the drinks menu -->
        <h2 class="menu-opt" id="drinks"><i class="fa-solid fa-champagne-glasses"></i> Drinks</h2>
        <div class="flex-container just">
            <?php foreach($drinks as $drink){ ?>
                <div class="card">
                    <div class="name">
                        <span><?php echo ''.str_replace("Drink ", "", $drink['name']); ?></span>
                    </div>
                    <div class="img">
                        <?php echo '<img src="data:image;base64,'.base64_encode($drink['img']).'">' ?>
                    </div>
                    <hr>
                    <div class="ing">
                        <h3>Ingredients</h3>
                        <ul>
                        <?php $ings = explode(", ", $drink['ingredients']);
                            foreach($ings as $ing){?>
                                <li><?php echo $ing; ?></li>
                        <?php }?> 
                        </ul>    
                    </div>
                    <hr>
                    <div class="price">
                        <span><?php echo $drink['price']; ?> L.E.</span>
                        <!-- hidden div to store price -->
                        <span style="display: none;"><?php echo $drink['price']; ?></span>
                    </div>
                    <div class="add">
                        <form action="menu.php" method="POST">
                            <select name="size" id="size" required>
                                <option value="s">S</option>
                                <option value="m">M</option>
                                <option value="l">L</option>
                            </select>
                            <input class="qtt" type="number" name="quantity" value="1" min="1" max="10" placeholder="Quantity" required>
                            <input type="hidden" name="product_id" value="<?=$drink['id']?>">
                            <button class="add-bt" type="submit" name="add">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    <!-- This is the footer -->
    <?php include("templates/footer.php"); ?>
    <script>
        // grab elements for the size changing
        var elements = document.getElementsByTagName("select");

        // call back for changing size
        sizePrice = function(){
            // grab real price in invisible div
            var real_price = this.parentNode.parentNode.previousElementSibling.childNodes[5].innerText;
            // grab current displayed price
            var current_price = this.parentNode.parentNode.previousElementSibling.childNodes[1];
            console.log(real_price);
            // do calcs depending on size
            if (this.value == "s"){
                x = real_price;
                current_price.innerText = Math.round(x) + " L.E.";
            }  
            else if (this.value == "m"){
                x = parseFloat(real_price) * 0.5 + parseFloat(real_price);
                current_price.innerText = Math.round(x) + " L.E.";
            }
            else if (this.value == "l"){
                x = parseFloat(real_price) * 0.9 + parseFloat(real_price);
                current_price.innerText = Math.round(x) + " L.E.";
            }   
        }
        // add event listeners to all elements
        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', sizePrice, false);
        }
        
        // stay on same scroll position on relaod
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script> 
</body>
</html>