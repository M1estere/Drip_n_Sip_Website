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
    <?php include('common-systems/header.php'); ?>

    <header class="account-main-content-wrapper">
        <div class="main-content">
            <div class="info-block">
                <div class="user-photo">
                    <img src="assets/icons/person.png">
                </div>
                <div class="info">
                    <div class="left-info">
                        <p>Email</p>
                        <p>Username</p>
                        <p>Name</p>
                    </div>

                    <div class="right-info">
                        <p>7156643@gmail.com</p>
                        <p>Markussrae</p>
                        <p>Ilya</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-text-region">
            <div class="temp">
                <div class="edit-text">
                    <a href="#">Edit Profile -></a>
                </div>
            </div>
        </div>
    </header>

    <?php include('common-systems/footer.php'); ?>
</body>

</html>