<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Remove Product</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/remove-product.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        include '../server/db_connection.php';

        if (isset($_GET['name']) && isset($_GET['category'])) {
            $name = trim($_GET['name']);
            $category = trim($_GET['category']);

            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $product = mysqli_fetch_array($query);

                $product_id = $product['id'];

                $request = "DELETE FROM products WHERE id = '$product_id';";

                $query = mysqli_query($server_connection, $request);
                if ($query) {
                    $info_message = 'Product '.$name.' of '.$category.' successfully deleted!';
                } else {
                    $info_message = 'Something went wrong!';
                }
            } else {
                $info_message = 'Product '.$name.' does not exist';
            }
        }
    ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Remove product</span>
            </div>

            <div class="products-region">
                <?php
                    echo "
                        <p class='info-message'>$info_message</p>
                    ";
                ?>
                <table class="products-table" width="500px" height="500px">
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Category</b></td>
                        <td><b>Price</b></td>
                        <td><b>Calories</b></td>
                        <td><b>Picture</b></td>
                        <td><b>Delete</b></td>
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
                                
                                $lower_name = strtolower($name);
                                $lower_name = str_replace(' ', '_', $lower_name);

                                echo "<tr>";

                                echo "
                                    <td>$name</td>
                                    <td>$category</td>
                                    <td>$price</td>
                                    <td>$calories</td>
                                    <td>$picture</td>
                                    <td class='last-col'>
                                        <a href='?name=$lower_name&category=$category'>
                                            <div class='delete-button'>
                                                <button class='delete' id='delete-product'>X</button>
                                            </div>
                                        </a>

                                        <a href='change_product.php?name=$lower_name&category=$category'>
                                            <div class='delete-button'>
                                                <button class='change' id='delete-product'>C</button>
                                            </div>
                                        </a>
                                    </td>
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