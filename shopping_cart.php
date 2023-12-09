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

    <header class="main-info-wrapper">
        <div class="main-info">
            <div class="top-text">
                <span>Your Cart</span>
            </div>

            <div class="central-block">
                <div class="products-region">
                    <table class="cart-table">
                        <tr>
                            <td>PRODUCTS</td>
                            <td>PRICE</td>
                            <td>QUANTITY</td>
                            <td>TOTAL</td>
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

                                    echo "<tr>";
                                    echo "
                                        <td>
                                            <div class='product-section'>
                                                <img src='$picture'>
                                                <div class='info-texts'>
                                                    <span class='title'>$name</span><br>
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
                            <span class="title">Order Summary</span><br>
                            <hr width="100%" align="center" color="black">

                            <div class="info-block">
                                <div class="titles">
                                    <span>Positions</span>
                                    <span>Subtotal</span>
                                    <span>Delivery Cost</span>
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
                                    ?>
                                </div>
                            </div>
                            <form class="discount-form">
                                <input type="text" placeholder="Enter discount...">
                            </form>
                        </div>
                    </div>

                    <div class="checkout-button-region">
                        <button class="checkout-button">checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php include('templates/footer.php')?>
</body>

</html>