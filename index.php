<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Drip & Sip - Home</title>

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">

    <script src="js/carousel.js" defer></script>
    <script src="js/top_products.js" defer></script>
</head>

<body>
    <?php session_start(); ?>
    <?php include('server/check_for_cart.php');?>
    <?php include('templates/header.php');?>

    <section class="photos-carousel-wrapper">
        <section aria-label="Shop Photos">
            <div class="image-carousel" data-carousel>
                <button class="carousel-button prev" data-carousel-button hidden>&#8656</button>
                <button class="carousel-button next" data-carousel-button hidden>&#8658</button>

                <ul data-slides>
                    <li class="slide" data-active>
                        <img src="assets/carousel/shop-1.jpg" alt="Shop 1">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-2.webp" alt="Shop 2">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-3.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-4.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-5.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-6.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel/shop-7.png" alt="Shop 3">
                    </li>
                </ul>
            </div>
        </section>
    </section>

    <section class="notes-wrapper">
        <div class="notes-region container">
            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/plane_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        Delivery
                    </div>
                    <div class="desc">
                        Over the whole world
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/gift_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        Gifts
                    </div>
                    <div class="desc">
                        For all customers
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/sale_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        Sales
                    </div>
                    <div class="desc">
                        On regular basis
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/service_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        Support
                    </div>
                    <div class="desc">
                        Working for you 24/7
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-categories-wrapper">
        <div class="top-categories-region container">
            <p style="color: #03262A;" align="center">Top Categories</p>

            <div class="cat-buttons-region">
                <a href="products_display.php?category=mocha">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-1.webp'); background-repeat: no-repeat; background-size: cover;">
                        mocha
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p>View More</p>
                    </div>
                </a>

                <a href="products_display.php?category=latte">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-2.jpg');  background-repeat: no-repeat; background-size: cover;">
                        latte
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p>View More</p>
                    </div>
                </a>

                <a href="products_display.php?category=cappuccino">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-3.jpg');  background-repeat: no-repeat; background-size: cover;">
                        cappuccino
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p>View More</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="top-prod-wrapper">
        <div class="top-prod-region container">
            <p style="color: #03262A;" align="center">Top Products</p>

            <div class="prod-buttons-region">
                <div id="featured-button" class="prod-button" onclick="openFeatured()">
                    featured
                </div>
                <div id="hottest-button" class="prod-button" onclick="openHottest()">
                    hottest
                </div>
                <div id="best-button" class="prod-button" onclick="openBest()">
                    bestseller
                </div>
            </div>
            <div class="prod-region" id="featured">
                <?php
                    // display 4 random products for each section
                    include 'server/get_random_products.php';

                    $products = get_products(12);
                    $counter = 0;
                    foreach ($products as $name => $product_info) {
                        if ($counter >= 4) break;
                        $counter += 1;
                        $link = 'index.php?product_id='.$product_info['id'];

                        $category = $product_info['category'];
                        $name = $product_info['name'];
                        $price = '$'.$product_info['price'];
                        $calories = $product_info['calories'];
                        $picture_path = 'assets/coffee-products/'.$product_info['picture'];

                        $temp_name = strtolower($name);
                        $temp_name = str_replace(' ', '_', $temp_name);
                        $link = $link.'&name='.$temp_name;

                        echo "
                            <div class='prod-page'>
                                <div class='image'>
                                    <img src='$picture_path'>
                                </div>
                                <div class='info'>
                                    <p align='center'>$name</p>
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

                    $products = array_slice($products, 4);
                ?>
            </div>

            <div class="prod-region" id="hottest">
                <?php
                    // display 4 random products for each section
                    $counter = 0;
                    foreach ($products as $name => $product_info) {
                        if ($counter >= 4) break;
                        $counter += 1;
                        $link = 'index.php?product_id='.$product_info['id'];

                        $category = $product_info['category'];
                        $name = $product_info['name'];
                        $price = '$'.$product_info['price'];
                        $calories = $product_info['calories'];
                        $picture_path = 'assets/coffee-products/'.$product_info['picture'];

                        $temp_name = strtolower($name);
                        $temp_name = str_replace(' ', '_', $temp_name);
                        $link = $link.'&name='.$temp_name;

                        echo "
                            <div class='prod-page'>
                                <div class='image'>
                                    <img src='$picture_path'>
                                </div>
                                <div class='info'>
                                    <p align='center'>$name</p>
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

                    $products = array_slice($products, 4);
                ?>
            </div>

            <div class="prod-region" id="bestseller">
                <?php
                    // display 4 random products for each section
                    $counter = 0;
                    foreach ($products as $name => $product_info) {
                        if ($counter >= 4) break;
                        $counter += 1;
                        $link = 'index.php?product_id='.$product_info['id'];

                        $category = $product_info['category'];
                        $name = $product_info['name'];
                        $price = '$'.$product_info['price'];
                        $calories = $product_info['calories'];
                        $picture_path = 'assets/coffee-products/'.$product_info['picture'];

                        $temp_name = strtolower($name);
                        $temp_name = str_replace(' ', '_', $temp_name);
                        $link = $link.'&name='.$temp_name;

                        echo "
                            <div class='prod-page'>
                                <div class='image'>
                                    <img src='$picture_path'>
                                </div>
                                <div class='info'>
                                    <p align='center'>$name</p>
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
    </section>

    <section class="picture-gallery-wrapper">
        <div class="image-grid">
            <img src="assets/gallery/2.webp" alt="Gallery 2">
            <img class="image-grid-col-2 image-grid-row-2" src="assets/gallery/1.jpg" alt="Gallery 1">
            <img src="assets/gallery/3.jpg" alt="Gallery 3">
            <img src="assets/gallery/4.jpg" alt="Gallery 4">
            <img src="assets/gallery/5.jpg" alt="Gallery 5">
        </div>
    </section>

    <section class="blogs-wrapper">
        <div class="blogs-region container">
            <p id="title" align="center">Latest Blogs</p>

            <div class="blogs-section">
                <?php
                    include 'server/get_blogs.php';

                    $blogs = blogs();
                    foreach ($blogs as $num => $blog_info) {
                        $text = $blog_info['text'];
                        $picture_path = 'assets/'.$blog_info['picture'];
                        $title = $blog_info['title'];
                        $blog_date = date('d F Y', strtotime($blog_info['date']));

                        echo "
                            <div class='blog'>
                                <img src=$picture_path>
                                <div class='info'>
                                    <p id='reg'>$title</p>
                                    <span class='colored'>$blog_date</span><br>
                                    <span class='reg'>$text</span>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>
</body>

</html>