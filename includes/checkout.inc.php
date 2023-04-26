<?php

// include db
include("config/db_connect.php");

// strat session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// set current user session
$current_username = $current_email = "";

if (isset($_SESSION['username'])){
    if (!empty($_SESSION['username'])) {
        $current_username = $_SESSION['username'];
        $current_email = $_SESSION['email'];
    }
}

// check if user is authorized to access
if(!$_SESSION['fromMain']){
    //send user back
    header("Location: index.php");
}else{
    //reset the variable
    $_SESSION['fromMain'] = "false";
}

// ======= Variables ======= //
$errors = ["address" => "", "card_no" => "", "card_name" => "", "card_exp" => "", "card_cvv" => ""];
$address = "";
$card_no = "";
$card_name = "";
$card_exp = "";
$card_cvv = "";

// checkout and send all info to db
if (isset($_POST['checkout'])){
    // ======= Variables ======= //
    $address = $_POST['address'];
    $card_no = $_POST['card_no'];
    $card_name = $_POST['card_name'];
    $card_exp = $_POST['card_exp'];
    $card_cvv = $_POST['card_cvv'];
    $method = $_POST["method"];
    $notes = $_POST['notes'];
    $total = $_SESSION['total'];

    // ===== Validation ===== //
    //empty check
    if(empty($address)){
        $errors['address'] = "Do not leave address field empty";
    }
    // validate card
    if ($_POST['method'] == "card"){
        // emptyness check
        if(empty($card_no)){
            $errors['card_no'] = "Do not leave card number field empty";
        //regex check
        }else if(!preg_match('/^[0-9]{16}$/', $card_no)){
            $errors['card_no'] = "Invalid Credit Card";
        }

        // check empty
        if(empty($card_name)){
            $errors['card_name'] = "Do not leave card holder name field empty";
        }

        if(empty($card_exp)){
            $errors['card_exp'] = "Do not leave expiry empty";
        // regex check
        }else if (!preg_match('/^(01|02|03|04|05|06|07|08|09|10|11|12){1}\/[0-9]{2}$/', $card_exp)){
            $errors['card_exp'] = "Invalid Expiry Date";
        }

        if(empty($card_cvv)){
            $errors['card_cvv'] = "Do not leave cvv empty";
        }else if (!preg_match('/^[0-9]{3}$/', $card_cvv)){
            $errors['card_cvv'] = "Invalid CVV";
        }
    }
    // if no errors 
    if ($errors['address'] == "" and $errors['card_no'] == "" and $errors["card_exp"] == "" and $errors["card_cvv"] == "" and $errors["card_name"] == ""){
        // grab user from db
        $q = "SELECT id FROM `person` WHERE email LIKE '$current_email'";
        $result = mysqli_query($conn, $q);
        $person_id = mysqli_fetch_assoc($result)['id'];

        // store hashed card
        if ($method == "card"){
            // store card hashed in db
            $card_no = md5($card_no);
            $q = "INSERT INTO `cards` (`id`, `person_id`, `number`, `name`) VALUES (NULL, '$person_id', '$card_no', '$card_name')";
            mysqli_query($conn, $q);
        }

        // store address then grab address id to store full order info
        $q = "INSERT INTO `person_address` (`id`, `person_id`, `address`) VALUES (NULL, '$person_id', '$address')";
        mysqli_query($conn, $q);
        $address_id = mysqli_insert_id($conn);
        $q = "INSERT INTO `orders` (`id`, `person_id`, `person_address_id`, `delivery_notes`, `status`, `method`, `total`) VALUES (NULL, '$person_id', '$address_id', '$notes', 'ongoing', '$method', '$total')";
        mysqli_query($conn, $q);

        // store order details
        $order_id = mysqli_insert_id($conn);
        // loop over cart items
        foreach ($_SESSION['cart'] as $item){
            // get product id
            $prod_id = $item['product_id'];
            $q = "SELECT price FROM `pizzas` WHERE id LIKE '$prod_id'";
            $result = mysqli_query($conn, $q);
            // get price for each item
            $price = mysqli_fetch_assoc($result)['price'];

            // get size
            $temp = $item['size'];
            $q = "SELECT id FROM `sizes` WHERE size LIKE '$temp'";
            $result = mysqli_query($conn, $q);
            $size_id = mysqli_fetch_assoc($result)['id'];
            //get quantity
            $qtty = $item['quantity'];

            $q = "SELECT price FROM `sizes` WHERE id LIKE '$size_id'";
            $result = mysqli_query($conn, $q);
            $pr_size = mysqli_fetch_assoc($result);  // price inc from size

            $pr_total = ($price + (floatval($pr_size['price']) * $row['price'])) * $qtty;  // total price of order items

            // store everything in the order details
            $q = "INSERT INTO `order_details` (`id`, `prod_id`, `order_id`, `size_id`, `price`, `qtty`) VALUES (NULL, '$prod_id', '$order_id', '$size_id', '$pr_total', '$qtty')";
            mysqli_query($conn, $q);
        }
        // delete cart
        unset($_SESSION['cart']);
        header('Location: orders.php');
        exit();
    }
}

?>