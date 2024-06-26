<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Products</title>

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/products-page.css">
</head>

<body>
    <?php
        session_start();
    ?>
    <?php include('server/check_for_cart.php');?>
    <?php include('templates/header.php'); ?>

    <section class="main-info-wrapper">
        <div class="main-info-region container">
            <div class="top-text">
                <span data-i18="display-coffe-title">Your coffee, sir</span>
            </div>

            <div class="products-display">
                <?php
                    include 'server/search_product.php';

                    $category = isset($_GET['category']) ? $_GET['category'] : '';
                    $products = search($category);
                    foreach ($products as $name => $product_info) {
                        $category = lcfirst($category);

                        if (isset($_GET['search']))
                            $link = '?product_id='.$product_info['id'].'&category='.$category.'&search='.$_GET['search'];
                        else
                            $link = '?product_id='.$product_info['id'].'&category='.$category;
                        
                        $category = $product_info['category'];
                        $category = strtolower($category);
                        $category = str_replace(' ', '-', $category);

                        $name = $product_info['name'];
                        $name = strtolower($name);
                        $name = str_replace(' ', '-', $name);

                        $key_to_check = 'products-'.$category.'-'.$name;

                        $product_name = $product_info['name'];
                        $price = '$'.$product_info['price'];
                        $calories = $product_info['calories'];
                        $picture_path = 'assets/coffee-products/'.$product_info['picture'];

                        $temp_name = strtolower($product_name);
                        $temp_name = str_replace(' ', '_', $temp_name);
                        $link = $link.'&name='.$temp_name;

                        echo "
                            <div class='prod-page'>
                                <div class='image'>
                                    <img src='$picture_path'>
                                </div>
                                <div class='info'>
                                    <p align='center'>$product_name</p>
                                    <div class='outer'>
                                        <a href='$link'>
                                            <img src='assets/icons/simple/shop_brown.png'>
                                        </a>
                                        <div class='right'>
                                            <span id='price'>$price</span>
                                            <div>
                                                <span id='calories'>{$calories}</span>
                                                <span id='calories'>cal</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>

    <script type="module" src="js/translator.js"></script>
</body>

</html>