<?php

// include db
include("config/db_connect.php");

// include account code
include("includes/account.inc.php");

?>

<head>
    <title>Papa's Restaurant</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria orders"/>
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
            <h1>Papa's Account</h1>
        </div> 
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- this is the nav bar -->
    <?php include("templates/nav.php") ?>
    
    <div class="cart thin content-wrapper">
        <h3>Account Details</h3>
        <form action="account.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <td>Email</td>
                        <td><?=$person['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?=$person['name'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input type="text" value ="0<?=$person['phone'] ?>" name="phone">
                            <div class="danger"><p><?php echo $errors_phone?></p></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Addresses</td>
                        <td><?php foreach($addresses as $address){
                            echo $address['address']."<br>";
                            }?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="buttons" style="text-align:center;">
                                <input type="submit" value="Apply Changes" name="update">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script src="scripts/script.js" type="text/javascript"></script>

</body>
</html>