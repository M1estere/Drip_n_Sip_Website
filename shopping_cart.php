<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Shopping Cart</title>

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/shopping-cart.css">
</head>

<body>
    <?php session_start(); ?>
    <?php
        include 'server/get_cart.php';

        if (isset($_GET['action']) && isset($_GET['name'])) {
            $action = $_GET['action'];
            $name = $_GET['name'];

            $name = str_replace('_', ' ', $name);
            $name = ucfirst($name);

            if ($action == 'add') {
                add_element($name);  
            } else if ($action == 'remove') {
                remove_element($name);
            } else if ($action == 'delete') {
                delete_element($name);
            }
        }
    ?>
    <?php include('templates/header.php')?>

    <section class="main-info-wrapper">
        <div class="main-info container">
            <div class="top-text">
                <span data-i18="cart-title">Your Cart</span>
            </div>

            <div class="central-block">
                <div class="products-region">
                    <table class="cart-table">
                        <tr>
                            <td data-i18="cart-products-title">PRODUCTS</td>
                            <td data-i18="cart-price-title">PRICE</td>
                            <td data-i18="cart-quantity-title">QUANTITY</td>
                            <td data-i18="cart-total-title">TOTAL</td>
                            <td class="last-col"></td>
                        </tr>
                            <?php
                                $whole_order_sum = 0;
                                
                                $cart = get_cart();
                                
                                foreach ($cart as $num => $product_info) {
                                    $name = $product_info['name'];
                                    $lower_name = strtolower($name);
                                    $lower_name = str_replace(' ', '_', $lower_name);

                                    $category = $product_info['category'];
                                    $amount = $product_info['amount'];

                                    $price = $product_info['price'];
                                    $calories = $product_info['calories'];
                                    $picture = 'assets/coffee-products/'.$product_info['picture'];

                                    $total_price = (int)$amount * (float)$product_info['price'];
                                    $whole_order_sum += (float)$total_price;

                                    $total_price = '$'.$total_price;

                                    $key_category = $product_info['category'];
                                    $key_category = strtolower($key_category);
                                    $key_category = str_replace(' ', '-', $key_category);

                                    $key_name = $product_info['name'];
                                    $key_name = strtolower($key_name);
                                    $key_name = str_replace(' ', '-', $key_name);

                                    $key_to_check = 'products-'.$key_category.'-'.$key_name;
                                    echo "<tr>";
                                    echo "
                                        <td>
                                            <div class='product-section'>
                                                <img src='$picture'>
                                                <div class='info-texts'>
                                                    <span class='title' data-i18='$key_to_check'>$name</span><br>
                                                    <span class='regular'>$category</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class='price-info'>
                                                $$price
                                            </div>
                                        </td>
                                        <td>
                                            <div class='amount-changer'>
                                                <a href='?action=remove&name=$lower_name'>
                                                    <div class='minus'>
                                                        <span>-</span>
                                                    </div>
                                                </a>

                                                <div class='amount-text'>
                                                    $amount
                                                </div>

                                                <a href='?action=add&name=$lower_name'>
                                                    <div class='plus'>
                                                        <span>+</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class='total-info'>
                                                $total_price
                                            </div>
                                        </td>
                                        <td class='last-col'>
                                            <a href='?action=delete&name=$lower_name'>
                                                <div class='delete-button'>
                                                    <button class='delete' id='delete-product'>X</button>
                                                </div>
                                            </a>
                                        </td>
                                    ";
                                }
                                echo "</tr>";
                            ?>
                    </table>
                </div>

                <div class="left-container">
                    <div class="total-info-block">
                        <div class="sum-info-block">
                            <span class="title" data-i18="cart-summary">Order Summary</span><br>
                            <hr width="100%" align="center" color="black">

                            <div class="info-block">
                                <div class="titles">
                                    <span data-i18="cart-postions">Positions</span>
                                    <span data-i18="cart-subtotal">Subtotal</span>
                                    <span data-i18="cart-del-cost">Delivery Cost</span>
                                </div>
                                <div class="prices-info">
                                    <?php
                                        $max_cost = 100;

                                        $amount = 0;
                                        if (isset($_SESSION['cart_size'])) {
                                            $amount = $_SESSION['cart_size'];
                                        }

                                        $cost = (int)$amount * (float)$product_info['price'];
                                        
                                        $delivery_cost = 0;
                                        if ($amount > 20)  {
                                            $delivery_cost = 0;
                                        } else if ($cost != 0) {
                                            $delivery_cost = $max_cost / $cost;
                                            $delivery_cost = number_format((float)$delivery_cost, 2, '.', '');
                                        }
                                        
                                        echo "<span>$amount</span>";
                                        echo "<span>$$whole_order_sum</span>";
                                        echo "<span>$$delivery_cost</span>";

                                        $_SESSION['delivery_cost'] = $delivery_cost;
                                    ?>
                                </div>
                            </div>
                            <form class="discount-form">
                                <input type="text" placeholder="Enter discount..." data-i18="cart-discount-region">
                            </form>
                        </div>
                    </div>

                    <div class="checkout-button-region">
                        <?php
                            if (isset($_SESSION['cart_size']) && $_SESSION['cart_size'] > 0) {
                                echo "
                                    <form action='order_confirmation.php' method='GET'>
                                        <button class='checkout-button' data-i18='cart-checkout-btn'>checkout</button>
                                    </form>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('templates/footer.php')?>

    <script type="module" src="js/translator.js"></script>
</body>

</html>