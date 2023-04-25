<?php

if (isset($_POST['add'])){
    if (isset($_SESSION['cart'])){
        for ($i = 0; $i < count($_SESSION['cart']); $i++){
            if ($_POST['product_id'] == $_SESSION['cart'][$i]['product_id'] and $_POST['size'] == $_SESSION['cart'][$i]['size']){
                $qtt = $_POST['quantity'] + $_SESSION['cart'][$i]['quantity'];
                array_splice($_SESSION['cart'], $i, 1);
                array_push($_SESSION['cart'], ["product_id" => $_POST['product_id'], "quantity" => $qtt, "size" => $_POST['size']]);
                header('Location: ?');
                exit();
            }
        }
        array_push($_SESSION['cart'], ["product_id" => $_POST['product_id'], "quantity" => $_POST['quantity'], "size" => $_POST['size']]);
        header('Location: ?');
        exit();
    }else {
        $_SESSION['cart'] = [['product_id' => $_POST['product_id'], 'quantity' => $_POST['quantity'], 'size' => $_POST['size']]];
        header('Location: ?');
        exit();
    }
}

?>