<?php
    session_start();
?>
    <header class="top-black-wrapper">
        <div class="top-black-bar">
            <div>
                Welcome to our shop!
            </div>

            <div>
                Language EN-US
            </div>
        </div>
    </header>

    <header class="top-white-wrapper">
        <div class="top-white-bar">
            <div class="customer-support-region">
                <div class="support-image">
                    <img src="assets/icons/simple/service_black.png">
                </div>
                <div class="support-texts-region">
                    Customer Support<br> 123-456-7890
                </div>
            </div>

            <div class="logo-region">
                <div class="logo-block">
                    <img src="assets/logo.png">
                </div>
            </div>

            <div class="account-shopping-cart-region">
                <div class="person-image">
                    <a href="account_page.php">
                        <img src="assets/icons/simple/person_black.png">
                    </a>
                </div>

                <div class="shopping-cart-region">
                    <div class="shopping-cart">
                        <a href="shopping_cart.php">
                            <img src="assets/icons/simple/shop_black.png">
                        </a>
                    </div>

                    <div class="shopping-text">
                        <?php
                        $amount = 0;
                        if (isset($_SESSION['cart_size'])) {
                            $amount = $_SESSION['cart_size'];
                        }

                        echo "Shopping Cart ($amount items)";
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="nav-bar-wrapper">
        <div class="nav-bar-full">
            <div class="nav-menu">
                <div><a href="index.php">home</a></div>
                <div><a href="products_display.php?category=mocha">iced mocha</a></div>
                <div><a href="products_display.php?category=espresso">espresso</a></div>
                <div><a href="products_display.php?category=cappuccino">cappuccino</a></div>
                <div><a href="products_display.php">more</a></div>
            </div>

            <div class="search-container">
                <form method="GET" action="products_display.php">
                    <input type="text" placeholder="Search..." name="category" required minLength="1">
                    <input hidden type="text" placeholder="Search..." name="search" value="true">

                    <button type="submit">
                    <img src="assets/icons/simple/search_black.png" class="search-button">
                </button>
                </form>
            </div>
        </div>
    </header>