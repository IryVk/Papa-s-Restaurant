<?php

// initialize variables
$errors_search = "";
$recent = "";

$searched = false; // flag to know when a search happens

// ==== GET REQUEST ==== //
if (isset($_GET['val'])){
    $found = false;  // flag to know if prods were found
    // grab search query
    $query = $_GET['val'];

    // search for pizzas in db
    $q = "SELECT * FROM `pizzas` WHERE name LIKE '%$query%'";
    $results = mysqli_query($conn, $q);
    $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
    // set flag to true
    $searched = true;
    if (count($products) > 0){
        // set found to true if products are found
        $found = true;
    }
}

if (isset($_POST['search'])){
    $found = false;  // flag to know if prods were found
    // grab search query
    $query = $_POST['query'];
    // store cookie
    setcookie("search-val", $query, time() + 86400);
    // check empty
    if (empty($query)){
        $errors_search = "Do not leave search empty";
    }else {
        // search for pizzas
        $q = "SELECT * FROM `pizzas` WHERE name LIKE '%$query%'";
        $results = mysqli_query($conn, $q);
        $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
        // set flag to tru
        $searched = true;
        if (count($products) > 0){
            // set found to true if products are found
            $found = true;
        }
    }   
}

// store cookie if found
$recent = $_COOKIE['search-val'] ?? "";

?>