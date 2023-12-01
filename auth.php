<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Authorize Page</title>

    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/auth.js" defer></script>
</head>

<body>
    <header class="main-region">
        <div class="left-wrapper">
            <div id="head" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/carousel-images/shop-1.jpg'); background-repeat: no-repeat; background-size: cover;">
            </div>
            <div id="bg" style="background-color: black;">
            </div>
            <div class="left-full-region">
                <div class="top-block">
                    <a href="#"><img src="assets/person-white.png"></a>
                </div>

                <div class="middle-block"><br>
                    <p>Welcome to {shopName}</p>
                    <span>Lorem ipsum inspiring people</span>
                </div>

                <div class="bottom-block">
                    <img src="assets/social/facebook.png">
                    <img src="assets/social/twitter.png">
                    <img src="assets/social/vk.png">
                    <img src="assets/social/youtube.png">
                </div>
            </div>
        </div>


        <div class="right-wrapper">
            <div class="right-full-region">
                <div class="logo-region">
                    <img src="assets/blogs/shop-1.jpg">
                </div>

                <div class="auth-forms">
                    <div class="buttons-region">
                        <button id="register-button" type="button" class="toggle-button" onclick="register()">REGISTER</button>
                        <button id="login-button" type="button" class="toggle-button" onclick="login()">LOGIN</button>
                    </div>

                    <div class="forms-region">
                        <form id="register" class="input-group">
                            <input type="text" name="user_username" class="input-field" placeholder="Username" minlength="3" required>
                            <input type="text" name="user_name" class="input-field" placeholder="Name" minlength="3" required>
                            <input type="email" name="user_email" class="input-field" placeholder="E-mail" required>
                            <input type="password" name="user_password" class="input-field" placeholder="Password" minlength="4" required><br>
                            <button type="submit" class="submit-button">SIGN UP</button>
                        </form>
                        <form id="login" class="input-group">
                            <input type="text" name="user_username" class="input-field" placeholder="Username" minlength="3" required>
                            <input type="password" name="user_password" class="input-field" placeholder="Password" minlength="4" required><br>
                            <button type="submit" class="submit-button">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>