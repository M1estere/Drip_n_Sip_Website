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

                    $request = "SELECT * FROM clients;";

                    $query = mysqli_query($server_connection, $request);
                    if ($query) {
                        while ($client = mysqli_fetch_array($query)) {
                            echo "<div>";

                            $client_id = $client['id'];
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

                            echo "<hr noshade width='80%' style='margin-bottom: 50px;'>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
    </section>

</body>

</html>