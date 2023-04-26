<?php

include("includes/checkout.inc.php")

?>


<!DOCTYPE html>

<html>
<head>
    <title>Papa's Checkout</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar|Noto Sans">
    <link rel="stylesheet" href="styles/home_style.css">
    <link rel="stylesheet" href="styles/sign_style.css">
    <link rel="stylesheet" href="styles/nav_foot_style.css">
    <link rel="stylesheet" href="styles/cart_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="content-wrapper slim cart">
        <h3>Checkout</h3>
        <br>
        <form action="checkout.php" method="POST">
            <!-- address -->
            <label for="address">Address</label>
            <input type="text" name="address" value="<?php echo $address ?>" required>
            <div class="danger"><p><?php echo $errors['address'] ?></p></div>

            <!-- method -->
            <label for="method">Select Payment Method</label>
            <select type="text" name="method" required>
                <option value="card">Credit Card</option>
                <option value="cash">Cash</option>
            </select>

            <!-- credit card info -->
            <div class="credit">
                <!-- card no -->
                <label for="card_no">Card Number</label>
                <input type="text" name="card_no">
                <div class="danger"><p><?php echo $errors['card_no'] ?></p></div>

                <!-- card holder name -->
                <label for="card_name">Card Holder Name</label>
                <input type="text" name="card_name">
                <div class="danger"><p><?php echo $errors['card_name'] ?></p></div>

                <!-- expiry -->
                <label for="card_exp">Expiry Date</label>
                <input id="smol" type="text" name="card_exp">
                <div class="danger"><p><?php echo $errors['card_exp'] ?></p></div>

                <!-- cvv -->
                <label for="card_cvv">CVV</label>
                <input id="smol" type="text" name="card_cvv">
                <div class="danger"><p><?php echo $errors['card_cvv'] ?></p></div>
            </div>

            <!-- notes -->
            <textarea name="notes" placeholder="Delivery Notes"></textarea>

            <div class="buttons">
                <a href="cart.php">Back to Cart</a>
                <input type="submit" value="Checkout" name="checkout">
            </div>
        </form>  
    </div>
    <script src="scripts/script.js" type="text/javascript"></script>
    <script>
        // hide or show credit card area
        var elements = document.getElementsByClassName("credit")
        var select = document.getElementsByTagName("select")
        select[0].addEventListener('change', function(){
            if (select[0].value == "card"){
                elements[0].setAttribute("class", "credit")
            }else{
                elements[0].setAttribute("class", "credit hidden")
            }
        }, false)</script>
</body>
</html>