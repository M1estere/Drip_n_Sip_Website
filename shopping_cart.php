<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/shopping-cart.css">
</head>

<body>
    <?php include('templates/header.php')?>

    <header class="main-info-wrapper">
        <div class="main-info">
            <div class="top-text">
                <span>Your Cart</span>
            </div>

            <div class="central-block">
                <div class="products-region">
                    <table class="cart-table">
                        <tr>
                            <td>PRODUCTS</td>
                            <td>PRICE</td>
                            <td>QUANTITY</td>
                            <td>TOTAL</td>
                            <td class="last-col"></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-section">
                                    <img src="assets/coffee-products/mocha/mocha-2.png">
                                    <div class="info-texts">
                                        <p>Espresso</p>
                                        <span>Type 1</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price-info">
                                    $120.57
                                </div>
                            </td>
                            <td>
                                <div class="amount-changer">
                                    <div class="minus">
                                        <span>-</span>
                                    </div>

                                    <div class="amount-text">
                                        12
                                    </div>

                                    <div class="plus">
                                        <span>+</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="total-info">
                                    $1444.86
                                </div>
                            </td>
                            <td class="last-col">
                                <div class="delete-button">
                                    <button class="delete" id="delete-product">X</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-section">
                                    <img src="assets/coffee-products/mocha/mocha-2.png">
                                    <div class="info-texts">
                                        <p>Espresso</p>
                                        <span>Type 1</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price-info">
                                    $120.57
                                </div>
                            </td>
                            <td>
                                <div class="amount-changer">
                                    <div class="minus">
                                        <span>-</span>
                                    </div>

                                    <div class="amount-text">
                                        12
                                    </div>

                                    <div class="plus">
                                        <span>+</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="total-info">
                                    $1444.86
                                </div>
                            </td>
                            <td class="last-col">
                                <div class="delete-button">
                                    <button class="delete" id="delete-product">X</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-section">
                                    <img src="assets/coffee-products/mocha/mocha-2.png">
                                    <div class="info-texts">
                                        <p>Espresso</p>
                                        <span>Type 1</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="price-info">
                                    $120.57
                                </div>
                            </td>
                            <td>
                                <div class="amount-changer">
                                    <div class="minus">
                                        <span>-</span>
                                    </div>

                                    <div class="amount-text">
                                        12
                                    </div>

                                    <div class="plus">
                                        <span>+</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="total-info">
                                    $1444.86
                                </div>
                            </td>
                            <td class="last-col">
                                <div class="delete-button">
                                    <button class="delete" id="delete-product">X</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="left-container">
                    <div class="total-info-block">
                        <div class="sum-info-block">
                            <span class="title">Order Summary</span><br>
                            <hr width="100%" align="center" color="black">

                            <div class="info-block">
                                <div class="titles">
                                    <span>Positions</span>
                                    <span>Subtotal</span>
                                    <span>Delivery Fee</span>
                                </div>
                                <div class="prices-info">
                                    <span>15</span>
                                    <span>$150.57</span>
                                    <span>Free</span>
                                </div>

                            </div>
                            <form class="discount-form">
                                <input type="text" placeholder="Enter discount...">
                            </form>
                        </div>
                    </div>

                    <div class="checkout-button-region">
                        <button class="checkout-button">checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php include('templates/footer.php')?>
</body>

</html>