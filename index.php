<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Coffee Shop Home Page</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-footer.css">

    <script src="js/carousel.js" defer></script>
</head>

<body>
    <?php include('common-systems/header.php'); ?>

    <header class="photos-carousel-wrapper">
        <section aria-label="Shop Photos">
            <div class="image-carousel" data-carousel>
                <button class="carousel-button prev" data-carousel-button hidden>&#8656</button>
                <button class="carousel-button next" data-carousel-button hidden>&#8658</button>
                <ul data-slides>
                    <li class="slide" data-active>
                        <img src="assets/carousel-images/shop-1.jpg" alt="Shop 1">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-2.webp" alt="Shop 2">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-3.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-4.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-5.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-6.jpg" alt="Shop 3">
                    </li>
                    <li class="slide">
                        <img src="assets/carousel-images/shop-7.png" alt="Shop 3">
                    </li>
                </ul>
            </div>
        </section>
    </header>

    <header class="notes-wrapper">
        <div class="notes-region">
            <div class="note-block">
                <div class="image">
                    <img src="assets/notes-icons/plane.png">
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
                    <img src="assets/notes-icons/gift.png">
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
                    <img src="assets/notes-icons/sale.png">
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
                    <img src="assets/notes-icons/service.png">
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
    </header>

    <header class="top-categories-wrapper">
        <div class="top-categories-region">
            <p align="center">Top Categories</p>

            <div class="cat-buttons-region">
                <div class="cat-button" onclick="alert('featured clicked')" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-1.webp'); background-repeat: no-repeat; background-size: cover;">
                    mocha
                    <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                    <p>View More</p>
                </div>
                <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-2.jpg');  background-repeat: no-repeat; background-size: cover;">
                    espresso
                    <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                    <p>View More</p>
                </div>
                <div class="cat-button" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/categories/cup-3.jpg');  background-repeat: no-repeat; background-size: cover;">
                    cappuccino
                    <hr style="height: 5px; width: 10%; border: none; background-color: white;">
                    <p>View More</p>
                </div>
            </div>
        </div>
    </header>

    <header class="top-prod-wrapper">
        <div class="top-prod-region">
            <p align="center">Top Products</p>

            <div class="prod-buttons-region">
                <div class="prod-button" onclick="alert('featured clicked')">
                    featured
                </div>
                <div class="prod-button">
                    hottest
                </div>
                <div class="prod-button">
                    bestseller
                </div>
            </div>
            <div class="prod-region">
                <div class="prod-page">
                    <div class="image">
                        <img src="assets/coffee-products/coffee-default.png">
                    </div>
                    <div class="info">
                        <p align="center">Irish Coffee</p>
                        <div>
                            <img src="assets/shop.png">
                            <span>$100</span>
                        </div>
                    </div>
                </div>
                <div class="prod-page">
                    <div class="image">
                        <img src="assets/coffee-products/mocha/mocha-4.png">
                    </div>
                    <div class="info">
                        <p align="center">Mocha</p>
                        <div>
                            <img src="assets/shop.png">
                            <span>$100</span>
                        </div>
                    </div>
                </div>
                <div class="prod-page">
                    <div class="image">
                        <img src="assets/coffee-products/latte/latte-2.png">
                    </div>
                    <div class="info">
                        <p align="center">Espresso</p>
                        <div>
                            <img src="assets/shop.png">
                            <span>$100</span>
                        </div>
                    </div>
                </div>
                <div class="prod-page">
                    <div class="image">
                        <img src="assets/coffee-products/espresso/espresso-2.png">
                    </div>
                    <div class="info">
                        <p align="center">Matcha</p>
                        <div>
                            <img src="assets/shop.png">
                            <span>$200</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <header class="picture-gallery-wrapper">
        <div class="image-grid">
            <img src="assets/gallery/2.webp" alt="Gallery 2">
            <img class="image-grid-col-2 image-grid-row-2" src="assets/gallery/1.jpg" alt="Gallery 1">
            <img src="assets/gallery/3.jpg" alt="Gallery 3">
            <img src="assets/gallery/4.jpg" alt="Gallery 4">
            <img src="assets/gallery/5.jpg" alt="Gallery 5">
        </div>
    </header>

    <header class="blogs-wrapper">
        <div class="blogs-region">
            <p align="center">Latest Blogs</p>

            <div class="blogs-section">
                <div class="blog">
                    <img src="assets/blogs/shop-1.jpg" alt="Blog 1">
                    <div class="info">
                        <p>Lorem Ipsum Dolor</p>
                        <span class="colored">05 December 2020</span><br>
                        <span class="reg">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...</span>
                    </div>
                </div>
                <div class="blog">
                    <img src="assets/blogs/shop-2.jpg" alt="Blog 1">
                    <div class="info">
                        <p>Lorem Ipsum Dolor</p>
                        <span class="colored">05 December 2020</span><br>
                        <span class="reg">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...</span>
                    </div>
                </div>
                <div class="blog">
                    <img src="assets/blogs/shop-3.jpg" alt="Blog 1">
                    <div class="info">
                        <p>Lorem Ipsum Dolor</p>
                        <span class="colored">05 December 2020</span><br>
                        <span class="reg">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore...</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php include('common-systems/footer.php'); ?>
</body>

</html>