<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Orders Control</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/clients.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Clients Information</span>
            </div>
            <div>
                <?php
                    include '../server/db_connection.php';

                    $request = "SELECT * FROM clients";

                    $query = mysqli_query($server_connection, $request);
                    if ($query) {
                        $request_2 = "SELECT count(user_id) as orders_amount FROM orders GROUP BY user_id ORDER BY orders_amount DESC LIMIT 1;";
                        $query_temp = mysqli_query($server_connection, $request_2);
                        $max_orders_amount = mysqli_fetch_array($query_temp)['orders_amount'];

                        while ($client = mysqli_fetch_array($query)) {
                            $is_max = false;
                            echo "<div>";
                            
                            $client_id = $client['id'];

                            $request_t = "SELECT count(user_id) as amount FROM orders WHERE user_id = '$client_id';";
                            $query_t = mysqli_query($server_connection, $request_t);
                            if ($query_t) {
                                $value = mysqli_fetch_array($query_t);
                                $amount = $value['amount'];
                                
                                if ($amount == $max_orders_amount)                               
                                    $is_max = true;
                            }

                            $client_username = $client['username'];
                            $client_name = $client['name'];
                            $client_mail = $client['email'];
                            $client_password = $client['password'];
                            
                            echo "
                                <div class='user-info-block'>
                                    <div class='left'>
                                        <p class='title'>Client Info</p>
                                        <p class='info'>
                                            <span><b>ID:</b> $client_id</span><br>
                                            <span><b>Username:</b> $client_username</span><br>
                                            <span><b>Name:</b> $client_name</span><br>
                                            <span><b>Email:</b> $client_mail</span><br>
                                            <span><b>Password:</b> $client_password</span>
                                        </p>
                                    </div>
                            ";

                            $request = "SELECT * FROM orders WHERE user_id = '$client_id';";

                            $new_query = mysqli_query($server_connection, $request);
                            if ($new_query) {
                                echo "
                                    <div class='right'>
                                        <table class='orders-table'>
                                            <tr>
                                                <td><b>Order Date</b></td>
                                                <td><b>Order Size</b></td>
                                                <td><b>Order Cost</b></td>
                                            </tr>
                                ";

                                while ($order = mysqli_fetch_array($new_query)) {
                                    $cost = $order['price'];
                                    $size = $order['amount'];
                                    $date = $order['creation_date'];

                                    echo "<tr>";
                                    echo "
                                        <td>$date</td>
                                        <td>$size</td>
                                        <td>$cost</td>
                                    ";
                                    echo "</tr>";
                                }

                                echo "
                                        </table>
                                    </div>
                                ";
                                echo "</div>";
                            }

                            if ($is_max)
                                echo "<div class='best-customer-region'>Our best customer</div>";
    
                            echo "<hr noshade width='80%' style='margin-bottom: 50px;'>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
    </section>

</body>

</html>