<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Page</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/account-page.css">
</head>

<body>
    <?php include('templates/header.php'); ?>

    <header class="main-info-wrapper">
        <div class="main-info">
            <div class="top-bar">
                <div class="top-text">
                    <span>Your Cart</span>
                </div>

                <div class="sign-out-button">
                    <button class="sign-out">sign out</button>
                </div>
            </div>
            <div class="info-block">
                <div class="left-panel">
                    <div class="top">
                        <img src="assets/icons/person.png">
                        <div class="texts">
                            <span class="nickname">m1estere</span>
                            <span class="email">7156643@gmail.com</span>
                        </div>
                    </div>

                    <div class="bottom">
                        <span>Personal Information</span>
                        <span>Billing Information</span>
                        <span>Order History</span>
                    </div>
                </div>

                <div class="right-panel">

                </div>
            </div>
        </div>
    </header>

    <?php include('templates/footer.php'); ?>
</body>

</html>