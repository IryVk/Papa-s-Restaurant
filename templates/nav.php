<nav>
    <table>
        <tr>
            <td>
                <a href="index.php">Home</a>
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
            <?php if ($current_email == "admin@admin.com"){ ?>
                <a href="index_a.php">Admin</a>
            <?php } else { ?>
                <a href="orders.php">Orders</a>
            <?php } ?>
            </td>
            <td>
                <a href="search.php">Search</a>
            </td>
            <td>
                <a href="reviews.php">Reviews</a>
            </td>
        </tr>
    </table>
</nav>