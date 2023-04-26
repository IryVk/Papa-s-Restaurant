<?php

// strat session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// remove item from session cart
if (isset($_POST['remove'])){
    for ($i = 0; $i < count($_SESSION['cart']); $i++){
        if ($_POST['del_id'] == $_SESSION['cart'][$i]['product_id']){
            array_splice($_SESSION['cart'], $i, 1);
            header('Location: ?');
            exit();
        }
    }
}

// updat item qtty
if (isset($_POST['update'])){
    for ($i = 0; $i < count($_SESSION['cart']); $i++){
        if ($_SESSION['cart'][$i]['quantity'] != $_POST['quantity-'.$_SESSION['cart'][$i]['product_id']]){
            $_SESSION['cart'][$i]['quantity'] = $_POST['quantity-'.$_SESSION['cart'][$i]['product_id']];
        }
    }
}

// redirect to chekout page and give authorization
if (isset($_POST['placeorder'])){
    $_SESSION['fromMain'] = true;
    header('Location: checkout.php');
    exit();
}

?>