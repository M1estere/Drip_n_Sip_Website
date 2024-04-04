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
        include 'support/translator.php';

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
            $name = str_replace('_', ' ', $name);
            $name = str_replace('-', ' ', $name);
            $name = ucwords($name);

            $category = trim($_GET['category']);
            $category = str_replace('_', ' ', $category);
            $category = str_replace('-', ' ', $category);

            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $product = mysqli_fetch_array($query);

                $product_id = $product['id'];

                $request = "DELETE FROM products WHERE id = '$product_id';";

                $query = mysqli_query($server_connection, $request);
                if ($query) {
                    $picture = $product['picture'];
                    unlink('../assets/coffee-products/'.$picture);

                    $temp_name = $name;
                    $temp_cat = $category;

                    $temp_name = strtolower($temp_name);
                    $temp_name = str_replace(' ', '-', $temp_name);
                    $temp_name = str_replace('_', '-', $temp_name);
                    
                    $temp_cat = strtolower($temp_cat);
                    $temp_cat = str_replace(' ', '-', $temp_cat);

                    $translate_key = 'products-'.$temp_cat.'-'.$temp_name;
                    if (delete_text_from_translations($translate_key))
                        $info_message = 'Product '.$name.' of '.$category.' successfully deleted!';
                    else 
                        $info_message = 'Something went wrong!';
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
                <!-- <?php
                    echo "
                        <p class='info-message'>$info_message</p>
                    ";
                ?> -->

                <?php
                    require '../server/db_connection.php';

                    $request = 'SELECT * FROM products';
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

                            echo "
                                <div class='product-card'>
                                    <div class='image-region'>
                                        <img src='$picture_path'>
                                    </div>
                                    
                                    <div class='content-region'>
                                        <span><b>Name:</b> $name</span>
                                        <span><b>Category:</b> $category</span>
                                        <span><b>Price:</b> $price</span>
                                        <span><b>Cal.:</b> $calories</span>
                                    </div>

                                    <div class='edit-content-region'>
                                        <div>
                                            <span><b>Name:</b></span>
                                            <input type='text' name='product_name' value=$name />
                                        </div>

                                        <div>
                                            <span><b>Category:</b></span>
                                            <input type='text' name='product_category' value=$category />
                                        </div>

                                        <div>
                                            <span><b>Price:</b></span>
                                            <input type='number' name='product_price' value=$price />
                                        </div>

                                        <div>
                                            <span><b>Calories:</b></span>
                                            <input type='number' name='product_cal' value=$calories />
                                        </div>

                                        <input type='button' value='Save' />
                                    </div>

                                    <div class='actions-region'>
                                        <input type='button' value='Edit' />
                                        
                                        <input type='button' value='Delete' />
                                    </div>
                                </div>
                            ";
                        }
                    }
                ?>

                <!-- <table class="display-table" width="100%" height="500px">
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
                </table> -->
            </div>

            <form class="new-product-form" method="POST" action="new_product.php">
                <input type="submit" value="Add New Product">
            </form>
        </div>
    </section>

</body>

</html>