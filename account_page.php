<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Account</title>

    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/account-page.css">

    <script src="js/account_page.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <?php
        // check if no session -> go to auth page
        if (session_status() != PHP_SESSION_ACTIVE) {
            header("Location: /auth.php");
            die;
        } else {
            if (!isset($_SESSION['username']) || !isset($_SESSION['name']) || !isset($_SESSION['email'])) {
                header("Location: /auth.php");
                die;
            } else {
                $username = $_SESSION['username'];
                $name = $_SESSION['name'];
                $email = $_SESSION['email'];
            }
        }
    ?>

    <section class="main-info-wrapper">
        <div class="main-info container">
            <div class="top-bar">
                <div class="top-text">
                    <span data-i18="acc-page-acc-info">Account Information</span>
                </div>

                <div class="sign-out-button">
                    <button onclick="signOut()" class="sign-out" data-i18="acc-page-sign-out">sign out</button>
                </div>
            </div>
            <div class="info-block">
                <div class="left-panel">
                    <div class="top">
                        <img src="assets/icons/simple/person_black.png">
                        <div class="texts">
                            <?php
                                echo "<span class='nickname'>$username</span>";
                                echo "<span class='email'>$email</span>";
                            ?>
                        </div>
                    </div>

                    <div class="bottom">
                        <span id="pers-info-btn" onclick="enablePersInfoFunc()" data-i18="acc-page-personal-info">Personal Information</span>
                        <span id="bil-info-btn" onclick="enableBillingInfoFunc()" data-i18="acc-page-billing-info">Billing Information</span>
                        <span id="hist-info-btn" onclick="enableHistInfoFunc()" data-i18="acc-page-order-hist">Order History</span>
                    </div>
                </div>

                <div id="personal-info" class="right-panel">
                    <div class="common-info">
                        <span class="title" data-i18="acc-page-personal-info">Personal Information</span>
                        <span class="small" data-i18="acc-page-personal-info-desc">Manage your personal information, including name, email and your username</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <?php
                                    echo "<span class='bold' data-i18='acc-page-username'>Username</span>";
                                    echo "<span class='grey'>$username</span>";
                                ?>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <?php
                                    echo "<span class='bold' data-i18='acc-page-name'>Name</span>";
                                    echo "<span class='grey'>$name</span>";
                                ?>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <?php
                                    echo "<span class='bold' data-i18='acc-page-email'>Email</span>";
                                    echo "<span class='grey'>$email</span>";
                                ?>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold" data-i18='acc-page-country'>Country</span>
                                <span class="grey">Russia</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="billing-info" class="right-panel">
                    <div class="common-info">
                        <span class="title" data-i18="acc-page-billing-info">Billing Information</span>
                        <span class="small" data-i18="acc-page-billing-info-desc">Manage your billing information</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <span class="bold" data-i18="acc-page-billing-credit">Credit Card</span>
                                <span class="grey">Visa, Mastercard</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold" data-i18="acc-page-billing-paypal">PayPal</span>
                                <span class="grey" data-i18="acc-page-billing-paypal-desc">Fast and secure</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold" data-i18="acc-page-billing-online">Online</span>
                                <span class="grey" data-i18="acc-page-billing-paypal-desc">Fast and secure</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="order-history-info" class="right-panel">
                    <div class="common-info">
                        <span class="title" data-i18="acc-page-order-hist">Order History</span>
                        <span class="small" data-i18="acc-page-order-hist-desc">Watch your order history</span>
                    </div>

                    <div class="blocks-info-hist">
                        <?php
                            // display orders
                            include 'server/orders.php';

                            $orders_array = get_orders($_SESSION['id']);

                            foreach ($orders_array as $name => $info_array) {
                                $creation_date = date('d F Y', strtotime($info_array['creation_date']));
                                $price = '$'.$info_array['price'].' | '.$info_array['amount'].'<span data-i18="acc-page-order-hist-pcs">pcs</span>';
                                echo "
                                    <div class='text-block'>
                                        <div class='left'>
                                            <span class='bold'>$name | $creation_date</span>
                                            <span class='grey'>$price</span>
                                        </div>

                                        <div class='right'>
                                            <div class='circle'></div>
                                        </div>
                                    </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('templates/footer.php'); ?>

    <script type="module" src="js/translator.js"></script>
</body>

</html>