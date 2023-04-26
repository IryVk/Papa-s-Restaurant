<?php

// if user clicks add to cart
if (isset($_POST['add'])){
    // if the session already has a cart, append to it
    if (isset($_SESSION['cart'])){
        // check if item is already in cart
        for ($i = 0; $i < count($_SESSION['cart']); $i++){
            // if item is already in cart, add to the quantity
            if ($_POST['product_id'] == $_SESSION['cart'][$i]['product_id'] and $_POST['size'] == $_SESSION['cart'][$i]['size']){
                $qtt = $_POST['quantity'] + $_SESSION['cart'][$i]['quantity'];
                array_splice($_SESSION['cart'], $i, 1);
                array_push($_SESSION['cart'], ["product_id" => $_POST['product_id'], "quantity" => $qtt, "size" => $_POST['size']]);
                header('Location: ?');
                exit();
            }
        }
        // append product to cart
        array_push($_SESSION['cart'], ["product_id" => $_POST['product_id'], "quantity" => $_POST['quantity'], "size" => $_POST['size']]);
        header('Location: ?');
        exit();
    // if there is no cart for the session, make it
    }else {
        $_SESSION['cart'] = [['product_id' => $_POST['product_id'], 'quantity' => $_POST['quantity'], 'size' => $_POST['size']]];
        header('Location: ?');
        exit();
    }
}

?>