<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Page</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/account-page.css">
    <script src="js/account_page.js" defer></script>
</head>

<body>
    <?php include('templates/header.php'); ?>

    <header class="main-info-wrapper">
        <div class="main-info">
            <div class="top-bar">
                <div class="top-text">
                    <span>Account Information</span>
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
                                <span class="bold">Username</span>
                                <span class="grey">M1estere</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Name</span>
                                <span class="grey">Ilya</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Email</span>
                                <span class="grey">7156643@gmail.com</span>
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
                        <span class="small">Manage your personal information, including name, email and your username</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Username</span>
                                <span class="grey">M1estere</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Name</span>
                                <span class="grey">Ilya</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Email</span>
                                <span class="grey">7156643@gmail.com</span>
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

                <div id="order-history-info" class="right-panel">
                    <div class="common-info">
                        <span class="title">Order History</span>
                        <span class="small">Manage your personal information, including name, email and your username</span>
                    </div>

                    <div class="blocks-info">
                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Username</span>
                                <span class="grey">M1estere</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Name</span>
                                <span class="grey">Ilya</span>
                            </div>

                            <div class="right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="text-block">
                            <div class="left">
                                <span class="bold">Email</span>
                                <span class="grey">7156643@gmail.com</span>
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
            </div>
        </div>
    </header>

    <?php include('templates/footer.php'); ?>
</body>

</html>