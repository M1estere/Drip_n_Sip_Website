<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Update Product</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/change-product.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        include '../server/db_connection.php';

        $info_message = '';
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['calories']) && isset($_POST['picture'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $calories = $_POST['calories'];
            $picture = $_POST['picture'];

            $request = "UPDATE products SET name = '$name', type = '$category', price = '$price', calories = '$calories', picture = '$picture' WHERE id = '$id';";

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $info_message = 'Product '.$name.' successfully updated!';
            } else {
                $info_message = 'Something went wrong...';
            }
        }
    ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Change Product</span>
            </div>

            <div class="products-region">
                <form method="POST" action="change_product.php" class="form">
                    <?php
                        echo "
                            <p class='info-message'>$info_message</p>
                        ";
                    ?>

                    <?php
                        include 'categories.php';

                        $id = 0;

                        $name = $_GET['name'];
                        $name = str_replace('_', ' ', $name);
                        $name = ucwords($name);
                        $category = $_GET['category'];

                        $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

                        $query = mysqli_query($server_connection, $request);
                        if ($query) {
                            $product = mysqli_fetch_array($query);

                            $price = $product['price'];
                            $calories = $product['calories'];
                            $picture = $product['picture'];
                            $id = $product['id'];
                        }   

                        echo "
                            <div class='input-fields'>
                                <div class='form-block'>
                                    <p>Product ID</p>
                                    <input type='number' name='id' readonly required value='$id'>
                                </div>

                                <div class='form-block'>
                                    <p>Product Name</p>
                                    <input type='text' name='name' placeholder='New product name...' value='$name' required>
                                </div>
                        ";

                        echo "
                            <div class='form-block'>
                                <p>Product Price</p>
                        ";

                        echo "<select name='category' value='$category' required>";
                        $categories = get_categories();
                        foreach ($categories as $cat) {
                            if ($category == $cat)
                                echo "<option selected value='$cat'>$cat</option>";
                            else
                                echo "<option value='$cat'>$cat</option>";
                        }
                        echo "</select>";
                        echo "</div>";

                                
                        echo "
                                <div class='form-block'>
                                    <p>Product Price</p>
                                    <input type='number' name='price' value='$price' placeholder='New product price...' required>
                                </div>

                                <div class='form-block'>
                                    <p>Product Calories</p>
                                    <input type='number' value='$calories' name='calories' placeholder='New product calories...' required>
                                </div>

                                <div class='form-block'>
                                    <p>Product Picture</p>
                                    <input type='text' value='$picture' name='picture' placeholder='coffee-default.png' required>
                                </div>
                            </div>

                            <input type='submit' value='Save Product'>
                        ";
                    ?>
                </form>
            </div>
        </div>
    </header>

</body>

</html>