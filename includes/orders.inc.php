<?php 

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

// get user id
$q = "SELECT id FROM `person` WHERE email LIKE '$current_email'";
$result = mysqli_query($conn, $q);
$person_id = mysqli_fetch_assoc($result);

// if user is logged in finde orders
if (isset($person_id)){
    $person_id = $person_id['id'];
    $q = "SELECT * FROM `orders` WHERE person_id LIKE '$person_id'";
    $result = mysqli_query($conn, $q);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>