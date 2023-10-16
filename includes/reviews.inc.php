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

// find reviews
$q = "SELECT * FROM reviews";
$result = mysqli_query($conn, $q);
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Check if the form is submitted
if (isset($_POST['submit_review'])) {
    // Get the form data
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    if (!(empty($email) && empty($rating) && empty($review)) ){
        // Insert the review into the database
        $q = "INSERT INTO reviews (email, rating, review) VALUES ('$email', '$rating', '$review')";
        $result = mysqli_query($conn, $q);
    }
    
    header('Location: ?');
    exit();
}



?>