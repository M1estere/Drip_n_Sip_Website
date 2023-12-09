<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Admin Panel</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Welcome, admin</span>
            </div>

            <div class="products-region">
                <table class="products-table" width="500px" height="500px">
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Category</b></td>
                        <td><b>Price</b></td>
                        <td><b>Calories</b></td>
                        <td><b>Picture</b></td>
                    </tr>
                    <?php
                        include '../server/db_connection.php';

                        $request = "SELECT * FROM products;";

                        $query = mysqli_query($server_connection, $request);
                        if ($query) {
                            while ($product = mysqli_fetch_array($query)) {
                                $name = $product['name'];
                                $category = $product['type'];
                                $price = $product['price'];
                                $calories = $product['calories'];
                                $picture = $product['picture'];
                                
                                echo "<tr>";

                                echo "
                                    <td>$name</td>
                                    <td>$category</td>
                                    <td>$price</td>
                                    <td>$calories</td>
                                    <td>$picture</td>
                                ";

                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </header>

</body>

</html>