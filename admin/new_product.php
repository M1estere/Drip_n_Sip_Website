<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Add Product</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/new-product.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        include '../server/db_connection.php';

        $info_message = '';
        if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['calories']) && isset($_POST['picture'])) {
            $name = trim($_POST['name']);
            $category = trim($_POST['category']);
            $price = trim($_POST['price']);
            $calories = trim($_POST['calories']);
            $picture = trim($_POST['picture']);

            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

            $query = mysqli_query($server_connection, $request);
            $product = mysqli_fetch_array($query);
            if ($product) {
                $info_message = 'Product '.$name.' of '.$category.' already exists';
            } else {
                $request = "INSERT INTO products (name, type, price, calories, picture) VALUES ('$name', '$category', '$price', '$calories', '$picture');";

                $query = mysqli_query($server_connection, $request);
                if ($query) {
                    $info_message = 'Successfully added '.$name;
                } else {
                    $info_message = 'Something went wrong';
                }
            }
        }
    ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Add new product</span>
            </div>

            <div class="new-product-form">
                <form method="POST" action="new_product.php" class="form">
                    <?php
                        echo "
                            <p class='info-message'>$info_message</p>
                        ";
                    ?>

                    <div class="input-fields">
                        <div class="form-block">
                            <p>Product Name</p>
                            <input type="text" required minlength="4" name="name" placeholder="Product name...">
                        </div>

                        <div class="form-block">
                            <p>Product Category</p>
                            <!-- <input type="text" required minlength="3" name="category" placeholder="Product category..."> -->
                            <?php
                                include 'categories.php';
                                
                                echo "<select name='category' required>";

                                $categories = get_categories();
                                foreach ($categories as $category) {
                                    echo "<option value='$category'>$category</option>";
                                }
                                echo "</select>";
                            ?>
                        </div>

                        <div class="form-block">
                            <p>Product Price</p>
                            <input type="number" required minlength="1" name="price" placeholder="Product price...">
                        </div>

                        <div class="form-block">
                            <p>Product Calories</p>
                            <input type="number" required minlength="2" name="calories" placeholder="Product calories...">
                        </div>

                        <div class="form-block">
                            <p>Product Picture</p>
                            <input type="text" required minlength="4" name="picture" placeholder="coffee-default.png" value="coffee-default.png">
                        </div>
                    </div>

                    <input type="submit" value="Add Product">
                </form>
            </div>
        </div>
    </header>

</body>

</html>