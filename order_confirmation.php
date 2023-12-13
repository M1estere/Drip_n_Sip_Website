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
                    <span>Order Confirmation</span>
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
                            echo "<span>Total: $$total_price</span>";
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
                        <span class="title">Your Information</span>
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
                        <span class="title">Payment</span><br>
                        <div class="add-info">
                            <span class="main-info">VISA</span><br>
                            <span class="add">Visa card ending with 1234</span>
                        </div>
                    </div>

                    <div class="block">
                        <span class="title">Shipping Address</span>
                        <div class="add-info">
                            <span class="main-info">Russia, Moscow</span><br>
                            <span class="add">pr. Vernadskogo, 78/2,</span><br>
                            <span class="add">115547</span>
                        </div>
                    </div>

                    <div class="block">
                        <span class="title">Delivery Date</span>
                        <div class="add-info">
                            <?php
                                $date = date('d F Y');
                                $est_date = date('d F Y', strtotime($date.' + 2 days'));
                                
                                echo "<span class='main-info'>Today: $date</span><br>";
                                echo "<span class='add'>Estimated: $est_date</span><br>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="right-side">
                    <span class="title">Order Information</span>
                    <div class="main">
                        <table class="cart-table">
                            <tr>
                                <td>PRODUCT</td>
                                <td>PRICE</td>
                                <td>QUANTITY</td>
                                <td>TOTAL</td>
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

                                        echo "<tr>";
                                        echo "
                                            <td>
                                                <div class='product-section'>
                                                    <img src='$picture_path'>
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
                                        Subtotal: $$subtotal
                                    </div>

                                    <div class='del-cost'>
                                        Delivery Cost: $$delivery_cost
                                    </div><br>

                                    <div class='del-cost'>
                                        Total Cost: $$total_price
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
                <button class="leave-button">RETURN TO HOME PAGE</button>
            </form>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>
</body>

</html>