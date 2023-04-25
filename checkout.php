<?php

// include db
include("config/db_connect.php");
// strat session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// check if user is authorized to access
if(!$_SESSION['fromMain']){
    //send user back
    header("Location: home.php");
}else{
    //reset the variable
    $_SESSION['fromMain'] = "false";
}

//redirect user to cart
if (isset($_POST['back'])){
    header("Location: cart.php");
    exit();
}

// checkout and send all info to db
if (isset($_POST['checkout'])){
}

?>


<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="styles/cart_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="flex-container" id="head">
        <!-- Logo -->
        <?php include("templates/logo.php") ?>
        <div id="welcome">
            <h1>Papa's Pizza Cart</h1>
        </div> 
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- this is the nav bar -->
    <?php include("templates/nav.php") ?>
    <div class="content-wrapper slim cart">
        <h3>Checkout</h3>
        <br>
        <form action="checkout.php" method="POST">
            <label for="address">Address</label>
            <input type="text" name="address" required>
            <label for="method">Select Payment Method</label>
            <select type="text" name="method" required>
                <option value="cash">Cash</option>
                <option value="card">Credit Card</option>
            </select>
            <div class="credit hidden">
                <label for="card_no">Card Number</label>
                <input type="text" name="card_no" required>
                <label for="card_name">Card Holder Name</label>
                <input type="text" name="card_name" required>
                <label for="card_exp">Expiry Date</label>
                <input id="smol" type="text" name="card_exp" required>
                <div class="right">
                    <label for="card_cvv">CVV</label>
                    <input id="smol" type="text" name="card_cvv" required>
                </div>
            </div>
            <textarea name="notes "placeholder="Delivery Notes"></textarea>
            <div class="buttons">
                <input type="submit" value="Back To Cart" name="back">
                <input type="submit" value="Checkout" name="checkout">
            </div>
        </form>
        
    </div>
    <script>
        // hide or show credit card area
        var elements = document.getElementsByClassName("credit")
        var select = document.getElementsByTagName("select")
        select[0].addEventListener('click', function(){
            if (select[0].value == "card"){
                elements[0].setAttribute("class", "credit")
            }else{
                elements[0].setAttribute("class", "credit hidden")
            }
        }, false)


    </script> 
</body>
</html>