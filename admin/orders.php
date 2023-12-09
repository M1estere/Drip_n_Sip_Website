<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Orders</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/orders.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Clients' orders</span>
            </div>
            <table class="orders-table" width="500" height="500">
                <tr>
                    <td><b>Client ID</b></td>
                    <td><b>Client Username</b></td>
                    <td><b>Order Cost</b></td>
                    <td><b>Order Size</b></td>
                </tr>

                <?php
                    include '../server/db_connection.php';

                    $request = "SELECT * FROM orders JOIN clients WHERE user_id = clients.id;";

                    $query = mysqli_query($server_connection, $request);
                    if ($query) {
                        while ($order = mysqli_fetch_array($query)) {
                            $client_id = $order['user_id'];
                            $username = $order['username'];
                            $cost = $order['price'];
                            $size = $order['amount'];

                            echo "<tr>";

                            echo "
                                <td>$client_id</td>
                                <td>$username</td>
                                <td>$cost</td>
                                <td>$size</td>
                            ";

                            echo "</tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </header>

</body>

</html>