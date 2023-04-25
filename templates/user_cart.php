<?php

// ===== include validation and login ===== //
include("templates/validation.php");

// include cart code
include("templates/cart.inc.php");

?>


<!-- The cart and user icons -->
<div class="options">
            <div class="dropdown">
                <!-- php tag to only display login if user is logged in -->
            <i class="fa-solid fa-user fa-2xl" onclick="<?php if ($current_username == ""){ echo "document.getElementById('signup').style.display='block'"; } ?>"></i>
                <div class="dropdown-content" id="user">
                <!-- show this if user logged in -->
                <?php if ($current_username != ""){ ?>
                    <a href="#">Account</a>
                    <a href="#">Orders</a>
                    <a href="templates/logout.php">Logout</a>
                <?php }else { ?>
                    <a href="#" onclick="document.getElementById('signup').style.display='block'">Sign Up/In</a>
                <?php } ?>
                </div>
              </div>
        </div>
<div class="options">
    <a href="cart.php" title="View Cart"><i class="fa-solid fa-cart-shopping fa-2xl badge" value=
    <?php if (isset($_SESSION['cart'])){
        // count items in cart to display as number
        $count = 0;
        foreach ($_SESSION['cart'] as $item){
            $count += $item['quantity'];
        }
        echo $count;
        }else{echo 0;} ?>></i></a>
</div>


<!-- Sign Up form -->
<div id="signup" class="modal">
    <!-- close button -->
    <span onclick="document.getElementById('signup').style.display='none'" class="close" title="Close Modal"><i class="fa-solid fa-circle-xmark"></i></span>

    <form class="modal-content" action="?" method="POST">
        <div class="container">
            <h1>Sign Up</h1>
            <p>Fill in this form to create an account with Papa's!</p>
            <hr>
            <!-- name -->
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" value="<?php echo $name ?>" required>
            <div class="danger"><p><?php echo $errors['name'] ?></p></div>

            <!-- phone -->
            <label for="phone"><b>Phone Number</b></label>
            <input type="text" placeholder="Enter Phone Number" name="phone" value="<?php echo $phone ?>" required>
            <div class="danger"><p><?php echo $errors['phone'] ?></p></div>

            <!-- email -->
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email ?>" required>
            <div class="danger"><p><?php echo $errors['email'] ?></p></div>

            <!-- password -->
            <label for="psw"><b>Password </b></label><a href="#" onclick="show();" id="toggle"><i class="fa-solid fa-eye"></i></a>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <div class="danger"><p><?php echo $errors['password'] ?></p></div>

            <!-- confirm password -->
            <label for="psw-repeat"><b>Confirm Password </b></label>
            <input type="password" placeholder="Confirm Password" name="psw-repeat" required>
            <div class="danger"><p><?php echo $errors['password_rep'] ?></p></div>

            <!-- remember me checkbox -->
            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <!-- switch to sign in page -->
            <p>Already have an account? <a href="#" onclick="document.getElementById('signup').style.display='none'; document.getElementById('signin').style.display='block'">Sign In</a></p>

            <!-- submit and cancel buttons -->
            <div class="clearfix">
                <button name="submit" type="submit" class="signupbtn">Sign Up</button>
                <br>
                <button type="button" onclick="document.getElementById('signup').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </div>
    </form>
</div>

<!-- Sign In form -->
<div id="signin" class="modal">
    <!-- close button -->
    <span onclick="document.getElementById('signin').style.display='none'" class="close" title="Close Modal"><i class="fa-solid fa-circle-xmark"></i></span>

    <form class="modal-content" action="?" method="post">
        <div class="container">
            <h1>Sign In</h1>
            <p>Log in to Your Papa's Account!</p>
            <hr>

            <!-- email -->
            <label for="emailin"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="emailin" value="<?php echo $email ?>" required>
            <div class="dangerin"><p><?php echo $errors['emailin'] ?></p></div>

            <!-- password -->
            <label for="pswin"><b>Password </b></label> <a href="#" onclick="show();" id="togglein"><i class="fa-solid fa-eye"></i></a>
            <input type="password" placeholder="Enter Password" name="pswin" required>
            <div class="dangerin"><p><?php echo $errors['passwordin'] ?></p></div>

            <!-- remember me -->
            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <!-- switch to sign up -->
            <p>Don't have an account? <a href="#" onclick="document.getElementById('signin').style.display='none'; document.getElementById('signup').style.display='block'">Sign Up</a></p>

            <!-- submit and cancel buttons -->
            <div class="clearfix">
                <button name="submitin" type="submit" class="signupbtn">Sign In</button>
                <br>
                <button type="button" onclick="document.getElementById('signin').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </div>
    </form>
</div> 

<script>
    // Get the modal
    var modal = document.getElementById('signup');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Get the modal
    var modal = document.getElementById('signin');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // toggle show and hide of password
    function show() {
        var t = document.getElementById("toggle");
        var x = t.nextElementSibling;
        var y = document.getElementById("togglein");
        var z = y.nextElementSibling;
        if (x.type === "password") {
            x.type = "text";
            t.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            z.type = "text"
            y.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
        } else {
            x.type = "password";
            t.innerHTML = '<i class="fa-solid fa-eye"></i>'
            z.type = "password";
            y.innerHTML = '<i class="fa-solid fa-eye"></i>'
        }
    }

    // show signup page when user submits wrong info
    function persistSignup(){
        divs = document.getElementsByClassName("danger")
        for (var i =0; i < divs.length; i++){
            if (divs[i].innerText != ""){ 
                var modal = document.getElementById('signup');
                modal.style.display = "block";
                divs[i].previousElementSibling.className = "error-input";
            }
        }
    }
    persistSignup();

    // show signin page when user submits wrong info
    function persistSignin(){
        divs = document.getElementsByClassName("dangerin")
        for (var i =0; i < divs.length; i++){
            if (divs[i].innerText != ""){ 
                var modal = document.getElementById('signin');
                modal.style.display = "block";
                divs[i].previousElementSibling.className = "error-input";
            }
        }
    }
    persistSignin();
    
</script>