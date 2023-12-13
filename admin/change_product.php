<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Update Product</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/form.css">

    <script src="js/browse_pic.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        include '../server/db_connection.php';

        $extensions = ['png', 'webp'];
        $info_message = '';
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['calories'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $price = $_POST['price'];
            $calories = $_POST['calories'];
            
            $time = time();
            $picture_name = $time.'_'.$_FILES['picture']['name'];
            
            $low_cat = strtolower($category);
            $picture_to_save = $low_cat.'/'.$picture_name;

            $ext = strtolower(pathinfo($picture_to_save, PATHINFO_EXTENSION));
            
            $test_path = '../assets/coffee-products/'.$picture_to_save;
            if (file_exists($test_path)) {
                $info_message = $info_message.' '.'File '.$picture_to_save.' exists';
                $request = "UPDATE products SET name = '$name', type = '$category', price = '$price', calories = '$calories' WHERE id = '$id';";
            } else {
                move_uploaded_file($_FILES['picture']['tmp_name'], $test_path);
                if (in_array($ext, $extensions)) {
                    $request = "UPDATE products SET name = '$name', type = '$category', price = '$price', calories = '$calories', picture = '$picture_to_save' WHERE id = '$id';";
                } else {
                    $request = "UPDATE products SET name = '$name', type = '$category', price = '$price', calories = '$calories' WHERE id = '$id';";
                }
            }

            $query = mysqli_query($server_connection, $request);
            if ($query) {
                $info_message = $info_message.' '.'Product '.$name.' successfully updated!';

                $temp_name = $name;
                $temp_name = str_replace(' ', '_', $temp_name);
                $temp_name = strtolower($temp_name);
                $get = 'action=change&change_name='.$temp_name;
                header("Location: products.php?".$get);
                die;
            } else {
                $info_message = $info_message.' '.'Something went wrong...';
            }
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span>Change Product</span>
            </div>

            <div class="display-region">
                <form method="POST" action="change_product.php" class="form" enctype="multipart/form-data">
                    <?php
                        echo "
                            <p class='info-message'>$info_message</p>
                        ";
                    ?>

                    <?php
                        include 'support/categories.php';

                        $name = $_GET['name'];
                        $name = str_replace('_', ' ', $name);
                        $name = ucwords($name);
                        $category = $_GET['category'];

                        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['calories'])) {
                            $request = "SELECT * FROM products WHERE id = '$id';";

                            $query = mysqli_query($server_connection, $request);
                            if ($query) {
                                $product = mysqli_fetch_array($query);
    
                                $name = $product['name'];
                                $category = ucfirst($product['type']);

                                $price = $product['price'];
                                $calories = $product['calories'];
                                $picture = $product['picture'];
                                
                                $path = '../assets/coffee-products/'.$picture;
                            }   
                        } else {
                            $request = "SELECT * FROM products WHERE name = '$name' AND type = '$category';";

                            $query = mysqli_query($server_connection, $request);
                            if ($query) {
                                $product = mysqli_fetch_array($query);
    
                                $price = $product['price'];
                                $calories = $product['calories'];
                                $picture = $product['picture'];
                                $path = '../assets/coffee-products/'.$picture;
                                $id = $product['id'];
                            }   
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
                                <p>Product Category</p>
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
                                    <div class='picture-container'>
                                        <input type='file' id='selectedFile' name='picture' accept='image/png, image/webp' style='display: none;' onchange='recheckFile()' value='$path'/>
                                        <input type='button' value='Browse Image...' onclick='chooseFile();'/>
                                        <img id='image' width='80px' height='auto' src='$path'>
                                    </div>
                                </div>
                            </div>

                            <input type='submit' value='Save Product'>
                        ";
                    ?>
                </form>
            </div>
        </div>
    </section>

</body>

</html>