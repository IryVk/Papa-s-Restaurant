<?php

// Grab Pizzas from db
$q = "SELECT * FROM `pizzas` WHERE name LIKE '%Pizza%'";
$result = mysqli_query($conn, $q);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

// Grab Sides from db
$q = "SELECT * FROM `pizzas` WHERE name LIKE '%Side%'";
$result = mysqli_query($conn, $q);
$sides = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

// Grab Drinks from db
$q = "SELECT * FROM `pizzas` WHERE name LIKE '%Drink%'";
$result = mysqli_query($conn, $q);
$drinks = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

 ?>