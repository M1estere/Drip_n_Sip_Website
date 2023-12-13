<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Products Control</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/display-table.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        // control display message when deleting/updating
        include '../server/db_connection.php';

        $info_message = '';
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            if ($action == 'add') {
                $info_message = 'Successfully added new product!';
            } else if ($action == 'change') {
                if (isset($_GET['change_name'])) {
                    $name = $_GET['change_name'];
                    $name = str_replace('_', ' ', $name);
                    $name = ucwords($name);
                    $info_message = 'Successfully changed '.$name;
                }
            }
        }

        // control deleting
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

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Products</span>
            </div>

            <div class="display-region">
                <?php
                    echo "
                        <p class='info-message'>$info_message</p>
                    ";
                ?>
                <table class="display-table" width="100%" height="500px">
                    <tr>
                        <td></td>
                        <td><b>Name</b></td>
                        <td><b>Category</b></td>
                        <td><b>Price</b></td>
                        <td><b>Calories</b></td>
                        <td></td>
                    </tr>

                    <?php
                        // fill contents
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
                                $picture_path = '../assets/coffee-products/'.$picture;

                                $lower_name = strtolower($name);
                                $lower_name = str_replace(' ', '_', $lower_name);

                                echo "<tr>";

                                echo "
                                    <td><img src='$picture_path' width='50px' height='auto'></td>
                                    <td>$name</td>
                                    <td>$category</td>
                                    <td>$price</td>
                                    <td>$calories</td>
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

            <form class="new-product-form" method="POST" action="new_product.php">
                <input type="submit" value="Add New Product">
            </form>
        </div>
    </section>

</body>

</html>