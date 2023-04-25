<?php

// ===== start session in all pages ===== //
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_cart = [];

$current_username = $current_email = "";

if (isset($_SESSION['username'])){
    if (!empty($_SESSION['username'])) {
        $current_username = $_SESSION['username'];
        $current_email = $_SESSION['email'];
    }
}
if (isset($_SESSION['cart'])){
    if (!empty($_SESSION['cart'])) {
        $current_cart = $_SESSION['cart'];
    }
}

?>


<div id="logo">
    <a href="home.php"><img id="logo_img" src="images/logo1.png"></a>
</div>