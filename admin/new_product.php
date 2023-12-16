<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - New Product</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">

    <script src="js/browse_pic.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>
    <?php include('support/translator.php'); ?>

    <?php
        include '../server/db_connection.php';

        $extensions = ['png', 'webp'];
        $info_message = '';
        if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['calories'])) {
            $name = trim($_POST['name']);
            $name = str_replace('_', ' ', $name);
            $name = str_replace('-', ' ', $name);
            $name = ucwords($name);

            $category = trim($_POST['category']);
            $category = str_replace('_', ' ', $category);
            $category = str_replace('-', ' ', $category);

            $price = trim($_POST['price']);
            $calories = trim($_POST['calories']);

            $picture = $_FILES['picture'];

            $time = time();
            $picture_name = $time.'_'.$picture['name'];
            $temp_name = $picture['tmp_name'];

            $low_cat = strtolower($category);
            $picture_to_save = $low_cat.'/'.$picture_name;
            $destination = '../assets/coffee-products/'.$picture_to_save;

            $extension = explode('.', $picture_name);
            $extension = end($extension);

            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

            $query = mysqli_query($server_connection, $request);
            $product = mysqli_fetch_array($query);
            if ($product) {
                $info_message = $info_message.' '.'Product '.$name.' of '.$category.' already exists';
            } else {
                $request = "INSERT INTO products (name, type, price, calories, picture) VALUES ('$name', '$category', '$price', '$calories', '$picture_to_save');";

                $query = mysqli_query($server_connection, $request);
                if ($query) {
                    if (in_array($extension, $extensions)) {
                        move_uploaded_file($temp_name, $destination);
                        $info_message = 'Image uploaded successfully!';
                    }

                    $info_message = $info_message.' '.'Successfully added '.$name;

                    $category = strtolower($category);
                    $category = str_replace(' ', '-', $category);

                    $main_name = $name;
                    $name = strtolower($name);
                    $name = str_replace(' ', '-', $name);
                    $translate_key = 'products-'.$category.'-'.$name;

                    $translate_value = $main_name;
                    if (insert_text_to_translations($translate_key, $translate_value)) {
                        header("Location: products.php?action=add");
                        die;
                    } else {
                        $info_message = $info_message.' '.'Something went wrong';
                    }
                } else {
                    $info_message = $info_message.' '.'Something went wrong';
                }
            }
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Add new product</span>
            </div>

            <div class="display-region">
                <form method="POST" action="new_product.php" class="form" enctype="multipart/form-data">
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
                            <?php
                                include 'support/categories.php';
                                
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
                            <div class="picture-container">
                                <input type="file" id="selectedFile" name="picture" accept="image/png" style="display: none;" onchange="recheckFile()" required/>
                                <input type="button" value="Browse Image..." onclick="chooseFile();"/>
                                <img id="image" width='80px' height='auto'>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Add Product">
                </form>
            </div>
        </div>
    </section>

</body>

</html>