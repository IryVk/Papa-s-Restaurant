<?php 

// start db connection
include("config/db_connect.php");

// ======= Variables ======= //
$errors = ["email" => "", "password" => "", "password_rep" => "", "name" => "", "phone" => "", "passwordin" => "", "emailin" => ""];
$email = "";
$password_rep = "";
$password = "";
$name = "";
$phone = "";

$q = "SELECT email FROM person";
$result = mysqli_query($conn, $q);
$past_emails = mysqli_fetch_all($result, MYSQLI_ASSOC);

// ======= VALIDATION ======= //
// ===== sign up ===== //
if (isset($_POST['submit'])){
    // ==== Variables ==== //
    $email = $_POST['email'];
    $password_rep = $_POST['psw-repeat'];
    $password = $_POST['psw'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // not empty
    if (empty($email)){
        $errors["email"] = "Do not leave email field empty";
        
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // validity of email
        $errors["email"] = "Enter a valid email";
    }
    // not repeated
    foreach($past_emails as $i){
        foreach($i as $p_email){
            if ($email == $p_email){
                $errors["email"] = "Email is already linked to an account";
            }
        }
    }
    
    //==== Validate password strength ====//
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    // not empty password
    if (empty($password)){
        $errors["password"] = "Do not leave password field empty";        
    } else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $errors["password"] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character';
    }

    // not empty name
    if (empty($name)){
        $errors["name"] = "Do not leave name field empty";        
    }

    // not empty and valid phone number
    if (empty($phone)){
        $errors["phone"] = "Do not leave phone field empty";        
    }else if(!preg_match('/^[0-9]{11}+$/', $phone)) {
        $errors["phone"] = "Enter a valid phone number";
    }

    // not empty and matching password
    if (empty($_POST['psw-repeat'])){
        $errors["password_rep"] = "Do not leave repeat password field empty";        
    }else if ($password_rep != $password){
        $errors['password_rep'] = "Passwords do not match";
    }

    // add account to database if no errors
    $password = password_hash($password, PASSWORD_DEFAULT);
    if ($errors['email'] == "" and $errors['password'] == "" and $errors["password_rep"] == "" and $errors["phone"] == "" and $errors["name"] == ""){
        $q = "INSERT INTO `person` (`id`, `email`, `phone`, `name`, `password`) VALUES (NULL, '$email', '$phone', '$name', '$password')"; // add to db
        mysqli_query($conn, $q); 
        // start session
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $name;
        header('Location: ?');
        exit();
    }
}
// ===== sign in ===== //
if (isset($_POST['submitin'])){
    $email = $_POST['emailin'];
    $password = $_POST['pswin'];
    // bool to know if email has account
    $found = false;
    if (empty($email)){
        $errors["emailin"] = "Do not leave email field empty";
        
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // validity of email
        $errors["emailin"] = "Enter a valid email";
    }else {
        // not empty
        foreach($past_emails as $i){
            foreach($i as $p_email){
                if ($email == $p_email){
                    $found = true;
                }
            }
        } 
    }
    if (!$found){$errors["emailin"] = "Email not found";}
        
    if (empty($_POST['pswin'])){
        $errors["passwordin"] = "Do not leave password field empty";        
    }else {
        if ($found){
            $q = "SELECT * FROM person WHERE email LIKE '$email'";
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])){
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $row['name'];
                header('Location: ?');
                exit();
            }else {
                $errors["passwordin"] = "Wrong password";
            }
        }
    }
}
?>