<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products Page</title>

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

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Your coffee, sir</span>
            </div>

            <div class="products-display">
                <?php
                    include 'server/search_product.php';

                    $products = search($_GET['category']);
                    foreach ($products as $name => $product_info) {
                        $category = lcfirst($_GET['category']);

                        $link = '?product_id='.$product_info['id'].'&category='.$_GET['category'].'&search='.$_GET['search'];

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
                                            <span id='calories'>{$calories}cal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </header>

    <?php include('templates/footer.php'); ?>
</body>

</html>