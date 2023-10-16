<?php 

// include db
include("config/db_connect.php");

// include reviews code
include("includes/reviews.inc.php")


?>

<!DOCTYPE html>

<html>
<head>
    <title>Papa's Reviews</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="papa's pizzeria orders"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sigmar|Noto Sans">
    <link rel="stylesheet" href="styles/home_style.css">
    <link rel="stylesheet" href="styles/sign_style.css">
    <link rel="stylesheet" href="styles/nav_foot_style.css">
    <link rel="stylesheet" href="styles/cart_style.css">
    <link rel="stylesheet" href="styles/reviews_style.css">
    <script src="https://kit.fontawesome.com/87d2511ba9.js" crossorigin="anonymous"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="flex-container" id="head">
        <!-- Logo -->
        <?php include("templates/logo.php") ?>
        <div id="welcome">
            <h1>Papa's Reviews</h1>
        </div> 
        <!-- This is the user icon and cart -->
        <?php include("templates/user_cart.php") ?>
    </div>
    <!-- this is the nav bar -->
    <?php include("templates/nav.php") ?>
    
    <div class="cart thick content-wrapper">
        <?php // Check if there are any reviews
            if (!empty($reviews)) {
                // Display existing reviews
                foreach ($reviews as $row) {
                    echo "<div class='review'>";
                    echo "<div class='review-email'>" . $row['email'] . "</div>";
                    echo "" . getStarRating($row['rating']) . "<br>";
                    echo "<p>" . $row['review'] . "</p><br>";
                    echo "<div class='review-time'>" . $row['created_at'] . "</div>";
                    echo "</div>";
                }
            } else {
                // No reviews yet
                echo "<div class='review'>No reviews yet.</div>";
            }

            // Function to generate star rating
            function getStarRating($rating) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        $stars .= '<span class="star">&#9733;</span>';
                    } else {
                        $stars .= '<span class="star">&#9734;</span>';
                    }
                }
                return $stars;
            }

            // Check if the user is logged in
            if ($current_username != "") {
                $email = $current_email; // Fetch the user's email from the session
                
                // Display review form
                // Display review form
                echo "<h3>Leave a Review</h3>";
                echo "<form action='reviews.php' method='POST'>";
                echo "<input type='hidden' name='email' value='$email'>"; // Use the fetched email as a hidden input
                echo "<textarea name='review' placeholder='Tell us your opinion!' required></textarea><br>";
                echo "<div class='rating'>";
                echo "<input type='radio' id='star5' name='rating' value='5'><label for='star5'></label>";
                echo "<input type='radio' id='star4' name='rating' value='4'><label for='star4'></label>";
                echo "<input type='radio' id='star3' name='rating' value='3'><label for='star3'></label>";
                echo "<input type='radio' id='star2' name='rating' value='2'><label for='star2'></label>";
                echo "<input type='radio' id='star1' name='rating' value='1' checked><label for='star1'></label>";
                echo "</div>";
                echo "<div class='buttons'><input name='submit_review' type='submit' value='Submit Review'></div>";
                echo "</form>";
            }
        ?>
    </div>

</body>
</html>