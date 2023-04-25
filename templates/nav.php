<nav>
    <table>
        <tr>
            <td>
                <a href="home.php">Home</a>
            </td>
            <td>
                <div class="dropdown">
                    <a href="menu.php">Menu ▼</a>
                    <div class="dropdown-content">
                        <a href="menu.php#pizzas">Pizzas</a>
                        <a href="menu.php#appt">Appetizers</a>
                        <a href="menu.php#drinks">Drinks</a>
                    </div>
                </div>
            </td>
            <td>
                <a href="contact.php">Contact</a>
            </td>
            <td>
            <?php if ($current_email == "admin@admin.com"){ ?>
                <a href="index.php">Admin</a>
            <?php } else { ?>
                <a href="about.php">About</a>
            <?php } ?>
            </td>
        </tr>
    </table>
</nav>