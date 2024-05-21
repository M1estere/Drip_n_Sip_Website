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
                        <span data-i18="main-notes-delivery">Delivery</span>
                    </div>
                    <div class="desc">
                    <span data-i18="main-notes-delivery-desc">Over the whole world</span>
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/gift_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        <span data-i18="main-notes-gifts">Gifts</span>
                    </div>
                    <div class="desc">
                        <span data-i18="main-notes-gifts-desc">For all customers</span>
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/sale_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        <span data-i18="main-notes-sales">Sales</span>
                    </div>
                    <div class="desc">
                        <span data-i18="main-notes-sales-desc">On regular basis</span>
                    </div>
                </div>
            </div>

            <div class="note-block">
                <div class="image">
                    <img src="assets/icons/simple/service_brown.png">
                </div>
                <div class="info">
                    <div class="title">
                        <span data-i18="main-notes-support">Support</span>
                    </div>
                    <div class="desc">
                        <span data-i18="main-notes-support-desc">Working for you 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="top-categories-wrapper">
        <div class="top-categories-region container">
            <p style="color: #03262A;" align="center" data-i18="main-top-categories">Top Categories</p>

            <div class="cat-buttons-region">
                <a href="products_display.php?category=mocha">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-1.webp'); background-repeat: no-repeat; background-size: cover;">
                        <span data-i18="main-top-categories-mocha">mocha</span>
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p data-i18="main-top-categories-view-more">View More</p>
                    </div>
                </a>

                <a href="products_display.php?category=latte">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-2.jpg');  background-repeat: no-repeat; background-size: cover;">
                        <span data-i18="main-top-categories-latte">latte</span>
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p data-i18="main-top-categories-view-more">View More</p>
                    </div>
                </a>

                <a href="products_display.php?category=cappuccino">
                    <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-3.jpg');  background-repeat: no-repeat; background-size: cover;">
                        <span data-i18="main-top-categories-cappuccino">cappuccino</span>
                        <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                        <p data-i18="main-top-categories-view-more">View More</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="top-prod-wrapper">
        <div class="top-prod-region container">
            <p style="color: #03262A;" align="center" data-i18="main-top-products">Top Products</p>

            <div class="prod-buttons-region">
                <div id="featured-button" class="prod-button" onclick="openFeatured()" data-i18="main-top-products-featured">
                    featured
                </div>
                <div id="hottest-button" class="prod-button" onclick="openHottest()" data-i18="main-top-products-hottest">
                    hottest
                </div>
                <div id="best-button" class="prod-button" onclick="openBest()" data-i18="main-top-products-best">
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
                        $category = strtolower($category);
                        $category = str_replace(' ', '-', $category);

                        $name = $product_info['name'];
                        $name = strtolower($name);
                        $name = str_replace(' ', '-', $name);

                        $key_to_check = 'products-'.$category.'-'.$name;

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
                                    <p align='center' data-i18='$key_to_check'>$name</p>
                                    <div class='outer'>
                                        <a href='$link'>
                                            <img src='assets/icons/simple/shop_brown.png'>
                                        </a>
                                        <div class='right'>
                                            <span id='price'>$price</span>
                                            <div>
                                                <span id='calories'>{$calories} </span>
                                                <span id='calories' data-i18='cal-title'>cal</span>
                                            </div>
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
                        $category = strtolower($category);
                        $category = str_replace(' ', '-', $category);

                        $name = $product_info['name'];
                        $name = strtolower($name);
                        $name = str_replace(' ', '-', $name);

                        $key_to_check = 'products-'.$category.'-'.$name;

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
                                    <p align='center' data-i18='$key_to_check'>$name</p>
                                    <div class='outer'>
                                        <a href='$link'>
                                            <img src='assets/icons/simple/shop_brown.png'>
                                        </a>
                                        <div class='right'>
                                            <span id='price'>$price</span>
                                            <div>
                                                <span id='calories'>{$calories} </span>
                                                <span id='calories' data-i18='cal-title'>cal</span>
                                            </div>
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
                        $category = strtolower($category);
                        $category = str_replace(' ', '-', $category);

                        $name = $product_info['name'];
                        $name = strtolower($name);
                        $name = str_replace(' ', '-', $name);

                        $key_to_check = 'products-'.$category.'-'.$name;

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
                                    <p align='center' data-i18='$key_to_check'>$name</p>
                                    <div class='outer'>
                                        <a href='$link'>
                                            <img src='assets/icons/simple/shop_brown.png'>
                                        </a>
                                        <div class='right'>
                                            <span id='price'>$price</span>
                                            <div>
                                                <span id='calories'>{$calories} </span>
                                                <span id='calories' data-i18='cal-title'>cal</span>
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
            <p id="title" align="center" data-i18="main-latest-blogs">Latest Blogs</p>

            <div class="blogs-section">
                <?php
                    include 'server/get_blogs.php';

                    $blogs = blogs(3);
                    foreach ($blogs as $num => $blog_info) {
                        $text = $blog_info['text'];
                        $picture_path = 'assets/'.$blog_info['picture'];
                        $title = $blog_info['title'];
                        $blog_date = date('d F Y', strtotime($blog_info['date']));

                        $temp_title = $title;
                        $temp_title = strtolower($temp_title);
                        $temp_title = str_replace(' ', '-', $temp_title);
                        $temp_picture_path = pathinfo($picture_path, PATHINFO_FILENAME);
                        $key_to_check = 'blogs-'.$temp_picture_path.'-'.$temp_title;
                        $desc_key = $key_to_check.'-desc';

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

    <script type="module" src="js/translator.js"></script>
</body>

</html>