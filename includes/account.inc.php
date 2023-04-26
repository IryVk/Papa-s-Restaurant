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

// check if user is authorized to access
if(empty($current_username)){
    //send user back
    header("Location: home.php");
}

// grab person details
$q = "SELECT * FROM `person` WHERE email LIKE '$current_email'";
$result = mysqli_query($conn, $q);
$person = mysqli_fetch_assoc($result);

// grab person addresses
$person_id = $person['id'];
$q = "SELECT address FROM `person_address` WHERE person_id LIKE '$person_id'";
$result = mysqli_query($conn, $q);
$addresses = mysqli_fetch_all($result, MYSQLI_ASSOC);

// initialize error var
$errors_phone = "";
// update phone number
if (isset($_POST['update'])){
    if ($_POST['phone'] != $person['phone']){
        // not empty and valid phone number
        if (empty($_POST['phone'])){
            $errors_phone = "Do not leave phone field empty";      
        }else if(!preg_match('/^[0-9]{11}$/', $_POST['phone'])) {
            $errors_phone = "Enter a valid phone number";
        }else {
            $temp = $_POST['phone'];
            $q = "UPDATE `person` SET phone = '$temp' WHERE id LIKE '$person_id'";
            mysqli_query($conn, $q);
            header("Location: account.php");
            exit();
        }
    }
}

?>