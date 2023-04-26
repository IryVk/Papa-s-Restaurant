<?php

// include db
include("config/db_connect.php");

// include cart code
include("includes/cart_page.inc.php")


?>


<!DOCTYPE html>
<html>
<!DOCTYPE html>

<html>
<head>
    <title>Papa's Cart</title>
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
    <div class="cart content-wrapper">
        <form action="cart.php" method="POST" onsubmit="<?php if ($current_username == ""){ echo "forceLogin(event)"; } ?>">
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['cart'])): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You have no products added in your Cart</td>
                    </tr>
                    <?php else: ?>
                    <?php $subtotal = 0; ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <?php
                            // grab info from db 
                            $i = $item['product_id'];
                            $q = "SELECT * FROM `pizzas` WHERE id LIKE '$i'";
                            $result = mysqli_query($conn, $q);
                            $row = mysqli_fetch_assoc($result); // product info
                            $i = $item['size'];
                            $q = "SELECT price FROM `sizes` WHERE size LIKE '$i'";
                            $result = mysqli_query($conn, $q);
                            $pr_size = mysqli_fetch_assoc($result); // price inc from size
                            $price = $row['price'] + (floatval($pr_size['price']) * $row['price']); // price of product
                            $subtotal += $price * $item['quantity'];
                        ?>
                        <td class="img">
                            <?php echo '<img src="data:image;base64,'.base64_encode($row['img']).'">' ?>
                        </td>
                        <td>
                            <span><?=ucfirst($item['size'])?> <?=$row['name']?></span>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="del_id" value="<?=$item['product_id']?>">
                                <button type="submit" name="remove" class="remove"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td class="price"><?php echo $price; ?> L.E.</td>
                        <td class="quantity">
                            <input type="number" name="quantity-<?=$item['product_id']?>" value="<?=$item['quantity']?>" min="1" max="10" placeholder="Quantity" required>
                        </td>
                        <td class="price"><?=$price * $item['quantity']?> L.E.</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Subtotal</span>
                <span class="price"><?=$subtotal?> L.E.</span>
                <?php $_SESSION['total'] = $subtotal; ?>
            </div>
            <div class="buttons">
                <input type="submit" value="Apply Changes" name="update">
                <input type="submit" value="Checkout" name="placeorder">
            </div>
            <?php endif; ?>
        </form>
    </div>
    <script src="scripts/script.js" type="text/javascript"></script>
</body>
</html>
