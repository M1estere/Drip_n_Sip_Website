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
                    <span>Account Information</span>
                </div>

                <div class="sign-out-button">
                    <button onclick="signOut()" class="sign-out">sign out</button>
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
                        <span id="pers-info-btn" onclick="enablePersInfoFunc()">Personal Information</span>
                        <span id="bil-info-btn" onclick="enableBillingInfoFunc()">Billing Information</span>
                        <span id="hist-info-btn" onclick="enableHistInfoFunc()">Order History</span>
                    </div>
                </div>

                <div id="personal-info" class="right-panel">
                    <div class="common-info">
                        <span class="title">Personal Information</span>
                        <span class="small">Manage your personal information, including name, email and your username</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <?php
                        echo "<span class='bold'>Username</span>";
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
                        echo "<span class='bold'>Name</span>";
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
                        echo "<span class='bold'>Email</span>";
                        echo "<span class='grey'>$email</span>";
                    ?>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Country</span>
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
                        <span class="title">Billing Information</span>
                        <span class="small">Manage your billing information</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Credit Card</span>
                                <span class="grey">Visa, Mastercard</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">PayPal</span>
                                <span class="grey">Fast and secure</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Online</span>
                                <span class="grey">Fast and secure</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="order-history-info" class="right-panel">
                    <div class="common-info">
                        <span class="title">Order History</span>
                        <span class="small">Watch your order history</span>
                    </div>

                    <div class="blocks-info-hist">
                        <?php
                include 'server/orders.php';

                $orders_array = get_orders($_SESSION['id']);

                foreach ($orders_array as $name => $info_array) {
                    $price = '$'.$info_array['price'].' | '.$info_array['amount'].'pcs';
                    echo "
                        <div class='text-block'>
                            <div class='left'>
                                <span class='bold'>$name</span>
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
</body>

</html>