<?php 

// include db
include("config/db_connect.php");

// include order code
include("includes/orders.inc.php")


?>


<head>
    <title>Papa's Orders</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria orders"/>
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
            <h1>Papa's Orders</h1>
        </div> 
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- this is the nav bar -->
    <?php include("templates/nav.php") ?>
    
    <div class="cart thick content-wrapper">
    <?php if ($current_username == ""){?>
        <h3>Login to view your orders</h3>
    <?php }else if(empty($orders)){ ?>
        <h3>No orders have been made on this account</h3>
    <?php }else{ ?>
        <?php for ($i = count($orders) - 1; $i >= 0; $i--){ ?>
            <h3>Order #<?php echo $orders[$i]['id']?></h3>
            <table>
                <thead>
                    <tr>
                        <td colspan="2">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                        <td>Time Created</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // get order details
                    $temp = $orders[$i]['id'];
                    $q = "SELECT * FROM `order_details` WHERE order_id LIKE '$temp'";
                    $result = mysqli_query($conn, $q);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $product_no = count($details);

                    // get product details
                    foreach ($details as $product){
                        $product_id = $product['prod_id'];
                        $q = "SELECT * FROM `pizzas` WHERE id LIKE '$product_id'";
                        $result = mysqli_query($conn, $q);
                        $prod = mysqli_fetch_assoc($result);
                        
                        $temp = $product['size_id'];
                        $q = "SELECT * FROM `sizes` WHERE id LIKE '$temp'";
                        $result = mysqli_query($conn, $q);
                        $size = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                        <td class="img">
                            <?php echo '<img src="data:image;base64,'.base64_encode($prod['img']).'">' ?>
                        </td>
                        <td>
                            <span><?=ucfirst($size['size'])?> <?=$prod['name']?></span>
                            <br>
                        </td>
                        <td class="price"><?php echo $prod['price'] + $prod['price'] * $size['price']; ?> L.E.</td>
                        <td class="quantity"><?php echo $product['qtty'] ?></td>
                        <td class="price"><?=($prod['price'] + $prod['price'] * $size['price']) * $product['qtty'] ?> L.E.</td>
                        <td><?=$orders[$i]['created'] ?></td>
                        <td><?=$orders[$i]['status'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Subtotal</span>
                <span class="price"><?=$orders[$i]['total']?> L.E.</span>
            </div>
            <?php } ?>
        <?php } ?>
    </div>

</body>
</html>