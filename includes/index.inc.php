<?php

// strat session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ===== set current user session ===== //
$current_username = $current_email = "";

if (isset($_SESSION['username'])){
    if (!empty($_SESSION['username'])) {
        $current_username = $_SESSION['username'];
        $current_email = $_SESSION['email'];
    }
}

// check if authorized
if ($current_email != "admin@admin.com"){ ?>
    <h1>Access Denied</h1>
<?php } else { ?>

<?php } 

// find all orders
$q = "SELECT * FROM `orders`";
$result = mysqli_query($conn, $q);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// update order status
if (isset($_POST['update'])){
    // grab order and change status
    $temp = $_POST['status'];
    $order_id = $_POST['order_id'];
    $q = "UPDATE `orders` SET status = '$temp' WHERE id LIKE '$order_id'";
    mysqli_query($conn, $q);
    header("Location: index_a.php");
    exit();
}

// delete order
if (isset($_POST['delete'])){
    // grab order and delete row
    $order_id = $_POST['order_id'];
    $q = "DELETE FROM `orders` WHERE id LIKE '$order_id'";
    mysqli_query($conn, $q);
    header("Location: index_a.php");
    exit();
}

?>