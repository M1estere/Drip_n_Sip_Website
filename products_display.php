<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products Page</title>

    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/products-page.css">
</head>

<body>
    <?php include('common-systems/header.php'); ?>

    <header class="main-info-wrapper">
        <div class="main-info-region">
            <div class="top-text">
                <span>Your coffee, sir</span>
            </div>

            <div class="products-display">
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
            </div>
        </div>
    </header>

    <?php include('common-systems/footer.php'); ?>
</body>

</html>