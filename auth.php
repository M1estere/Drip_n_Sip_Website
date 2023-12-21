<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Drip & Sip - Authorization</title>

    <link rel="stylesheet" href="css/auth.css">

    <script src="js/auth.js" defer></script>
</head>

<body>
    <section class="main-region">
        <div class="left-wrapper">
            <div id="head" style="background: linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url('assets/carousel/shop-1.jpg'); background-repeat: no-repeat; background-size: cover;">
            </div>
            <div id="bg" style="background-color: black;">
            </div>
            <div class="left-full-region">
                <div class="top-block">
                    <a href="index.php"><img src="assets/logo.png"></a>
                </div>

                <div class="middle-block"><br>
                    <p data-i18="auth-welcome">Welcome to Drip & Sip</p>
                    <span data-i18="auth-welcome-desc">Inspiring people on great things</span>
                </div>

                <div class="bottom-block">
                    <a href="https://www.facebook.com/"><img src="assets/icons/colored/social/facebook.png"></a>
                    <a href="https://twitter.com/Ilya_Solov23"><img src="assets/icons/colored/social/twitter.png"></a>
                    <a href="https://vk.com/m1estere"><img src="assets/icons/colored/social/vk.png"></a>
                    <a href="https://www.youtube.com/channel/UCi3J1FxEFC-6fIig5IvjbSg"><img src="assets/icons/colored/social/youtube.png"></a>
                </div>
            </div>
        </div>

        <div class="right-wrapper">
            <div class="right-full-region">
                <div class="logo-region">
                    <img src="assets/blogs/designs.jpg">
                </div>

                <div class="auth-forms">
                    <div class="buttons-region">
                        <button id="register-button" type="button" class="toggle-button" onclick="register()" data-i18="auth-register-title">REGISTER</button>
                        <button id="login-button" type="button" class="toggle-button" onclick="login()" data-i18="auth-login-title">LOGIN</button>
                    </div>

                    <?php
                        include 'server/db_connection.php';

                        $reg_error = '';
                        $log_error = '';

                        session_start();
                        session_destroy();
                        authenticate($_POST);

                        function authenticate($data) {
                            if (isset($data['username']) && isset($data['name']) && isset($data['email']) && isset($data['password'])) {
                                register($data);
                            } else if (isset($data['username']) && isset($data['password'])) {
                                login($data);
                            }
                        }

                        function register($data) {
                            global $server_connection;
                            global $reg_error;

                            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                                $reg_error = '<span data-i18="auth-valid-email">Enter a valid email</span>';
                            }

                            if (trim($data['password']) < 4) {
                                $reg_error = '<span data-i18="auth-valid-pass">Enter a correct password</span>';
                            }

                            if (strlen($reg_error) == 0) {
                                $username = trim($data['username']);
                                $name = trim($data['name']);
                                $email = trim($data['email']);
                                $password = trim($data['password']);

                                $request = "SELECT * FROM clients WHERE username = '{$username}' or email = '{$email}'";
                                $query = mysqli_query($server_connection, $request);

                                $user = mysqli_fetch_array($query);
                                if (!$user) {
                                    $request = "INSERT INTO clients (username, name, email, password) VALUES ('{$username}', '{$name}', '{$email}', '{$password}');";
                                
                                    $query = mysqli_query($server_connection, $request);
                                    if ($query) {
                                        $request = "SELECT * FROM clients WHERE username = '{$username}';";
                                        $query = mysqli_query($server_connection, $request);
    
                                        $user = mysqli_fetch_array($query);
                                        if ($user) {
                                            session_start();
                                            $_SESSION['id'] = $user['id'];
                                            $_SESSION['username'] = $user['username'];
                                            $_SESSION['name'] = $user['name'];
                                            $_SESSION['email'] = $user['email'];
    
                                            $_POST = array();
                                            header('location: /../index.php');
                                            die;
                                        } else {
                                            $reg_error = '<span data-i18="auth-fetch-user-error">Some error occured when fetching user</span>';
                                        }
                                    } else {
                                        $reg_error = '<span data-i18="auth-fetch-db-error">Some error occured when fetching database</span>';
                                    }
                                } else {
                                    $reg_error = '<span data-i18="auth-user-exists">User already exists</span>';
                                }                                
                            }
                        }

                        function login($data) {
                            global $server_connection;
                            global $log_error;

                            $username = trim($data['username']);
                            $password = trim($data['password']);
                            
                            $request = "SELECT * FROM clients WHERE username = '{$username}';";
                            $query = mysqli_query($server_connection, $request);

                            $user = mysqli_fetch_array($query);
                            if ($user) {
                                $user_password = $user['password'];
                                if ($username == 'admin' && $password == $user_password) {
                                    $_POST = array();
                                    header('Location: admin/products.php');
                                    die;
                                }

                                if ($user_password == $password) {
                                    session_start();
                                    $_SESSION['id'] = $user['id'];
                                    $_SESSION['username'] = $user['username'];
                                    $_SESSION['name'] = $user['name'];
                                    $_SESSION['email'] = $user['email'];
    
                                    $_POST = array();
                                    header('Location: index.php');
                                    die;
                                } else {
                                    $log_error = '<span data-i18="auth-wrong-pass">Wrong password</span>';
                                }
                            } else {
                                $log_error = '<span data-i18="auth-no-user">User does not exist</span>';
                            }
                        }
                    ?>

                        <div class="forms-region">
                            <form method="POST" id="register" class="input-group">
                                <input type="text" name="username" class="input-field" placeholder="Username" minlength="3" required value='' data-i18="auth-username-field">
                                <input type="text" name="name" class="input-field" placeholder="Name" minlength="3" required data-i18="auth-name-field">
                                <input type="email" name="email" class="input-field" placeholder="E-mail" required data-i18="auth-email-field">
                                <input type="password" name="password" class="input-field" placeholder="Password" minlength="4" required data-i18="auth-pass-field"><br>

                                <button type="submit" class="submit-button" data-i18="auth-sign-up-btn">SIGN UP</button>

                                <?php
                                echo "
                                    <span align='center' class='error'>$reg_error</span>
                                ";
                            ?>
                            </form>

                            <form method="POST" id="login" class="input-group">
                                <input type="text" name="username" class="input-field" placeholder="Username" minlength="3" required data-i18="auth-username-field">
                                <input type="password" name="password" class="input-field" placeholder="Password" minlength="4" required data-i18="auth-pass-field"><br>

                                <button type="submit" class="submit-button" data-i18="auth-login-btn">LOGIN</button>

                                <?php
                                echo "
                                    <span align='center' class='error'>$log_error</span>
                                ";
                            ?>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <script type="module" src="js/translator.js"></script>
</body>

</html>