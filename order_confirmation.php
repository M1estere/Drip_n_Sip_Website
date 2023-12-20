<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Order Confirmation</title>

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/order-confirmation.css">
</head>

<body>
    <?php session_start(); ?>
    <?php
        if (isset($_SESSION['cart_size'])) {
            $cart_size_saved = $_SESSION['cart_size'];
            $_SESSION['cart_size'] = 0; 
        } else {
            header("Location: /index.php");
            die;
        }
    ?>
    <?php include('templates/header.php'); ?>

    <section class="main-info-wrapper">
        <div class="main-info container">
            <div class="top-texts">
                <div class="top-text">
                    <span data-i18="conf-order-conf-title">Order Confirmation</span>
                </div>

                <div class="top-text">
                    <?php
                        // count cart and leave if is empty
                        include 'server/db_connection.php';

                        if ($cart_size_saved >= 1) {
                            $total_price = 0;

                            $cart = $_SESSION['cart'];

                            foreach ($cart as $key => $cart_info) {
                                $id = $cart_info['id'];
                                $request = "SELECT * FROM products WHERE id = '$id';";

                                $query = mysqli_query($server_connection, $request);
                                if ($query) {
                                    $product = mysqli_fetch_array($query);

                                    $total = (float)$product['price'] * (int)$cart_info['amount'];
                                    $total_price += $total;
                                }
                            }

                            $delivery_cost = $_SESSION['delivery_cost'];
                            $total_price += $delivery_cost;
                            echo "<span data-i18='conf-order-total-title'>Total: </span><span>$$total_price</span>";
                        } else {
                            header("Location: /index.php");
                            die;
                        }
                    ?>
                </div>
            </div>

            <div class="top-block">
                <div class="left-side">
                    <div class="block">
                        <span class="title" data-i18="conf-your-info">Your Information</span>
                        <div class="add-info">
                            <?php
                                $name = $_SESSION['name'];
                                $username = $_SESSION['username'];
                                $email = $_SESSION['email'];

                                echo "<span class='main-info'>$username, $name</span><br>";
                                echo "<span class='add'>$email</span>";
                            ?>
                        </div>
                    </div>

                    <div class="block">
                        <span class="title" data-i18="conf-payment-title">Payment</span><br>
                        <div class="add-info">
                            <span class="main-info">VISA</span><br>
                            <span class="add" data-i18="conf-card-info">Visa card ending with 1234</span>
                        </div>
                    </div>

                    <div class="block">
                        <span class="title" data-i18="conf-ship-address">Shipping Address</span>
                        <div class="add-info">
                            <span class="main-info" data-i18="conf-ship-address-country">Russia, Moscow</span><br>
                            <span class="add" data-i18="conf-ship-address-desc">pr. Vernadskogo, 78/2,</span><br>
                            <span class="add">115547</span>
                        </div>
                    </div>

                    <div class="block">
                        <span class="title" data-i18="conf-del-date">Delivery Date</span>
                        <div class="add-info">
                            <?php
                                $date = date('d F Y');
                                $est_date = date('d F Y', strtotime($date.' + 2 days'));
                                
                                echo "<span class='main-info' data-i18='conf-today'>Today: </span><span class='main-info'>$date</span><br>";
                                echo "<span class='add' data-i18='conf-est'>Estimated:</span><span class='add'>$est_date</span><br>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="right-side">
                    <span class="title" data-i18='conf-order-info'>Order Information</span>
                    <div class="main">
                        <table class="cart-table">
                            <tr>
                                <td data-i18="cart-products-title">PRODUCT</td>
                                <td data-i18="cart-price-title">PRICE</td>
                                <td data-i18="cart-quantity-title">QUANTITY</td>
                                <td data-i18="cart-total-title">TOTAL</td>
                            </tr>
                            <?php
                                $cart = $_SESSION['cart'];

                                foreach ($cart as $key => $cart_info) {
                                    $id = $cart_info['id'];

                                    $request = "SELECT * FROM products WHERE id = '$id';";

                                    $query = mysqli_query($server_connection, $request);

                                    if ($query) {
                                        $product = mysqli_fetch_array($query);

                                        $picture = $product['picture'];
                                        $picture_path = 'assets/coffee-products/'.$picture;

                                        $name = $product['name'];
                                        $category = $product['type'];
                                        $price = $product['price'];
                                        $amount = $cart_info['amount'];

                                        $total = (float)$price * (int)$amount;

                                        $key_category = $product['type'];
                                        $key_category = strtolower($key_category);
                                        $key_category = str_replace(' ', '-', $key_category);

                                        $key_name = $product['name'];
                                        $key_name = strtolower($key_name);
                                        $key_name = str_replace(' ', '-', $key_name);

                                        $key_to_check = 'products-'.$key_category.'-'.$key_name;
                                        echo "<tr>";
                                        echo "
                                            <td>
                                                <div class='product-section'>
                                                    <img src='$picture_path'>
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
                                                    <div class='amount-text'>
                                                        $amount
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class='total-info'>
                                                    $$total
                                                </div>
                                            </td>
                                        ";
                                        echo "</tr>";
                                    }
                                }

                                $user_id = $_SESSION['id'];
                                $amount = $cart_size_saved;
                                $current_date = date('Y-m-d');

                                $request = "INSERT INTO orders (user_id, amount, price, creation_date) VALUES ('$user_id', '$amount', '$total_price', '$current_date');";

                                $query = mysqli_query($server_connection, $request);
                                if (!$query) {
                                    echo "Some error occured";
                                }

                                $_SESSION['cart'] = array();
                            ?>
                        </table>
                        <?php
                            $subtotal = $total_price - $delivery_cost;
                            echo "
                                <div class='del-cost-region'>
                                    <div class='del-cost'>
                                        <span data-i18='cart-subtotal'>Subtotal</span>: $$subtotal
                                    </div>

                                    <div class='del-cost'>
                                        <span data-i18='cart-del-cost'>Delivery Cost</span>: $$delivery_cost
                                    </div><br>

                                    <div class='del-cost'>
                                        <span data-i18='conf-total-cost'>Total Cost</span>: $$total_price
                                    </div>
                                </div>
                            ";
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="leave-button-region">
            <form action="index.php" method="POST">
                <button class="leave-button" data-i18="conf-return-btn">RETURN TO HOME PAGE</button>
            </form>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>

    <script type="module" src="js/translator.js"></script>
</body>

</html>