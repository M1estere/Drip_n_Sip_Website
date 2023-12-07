<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Authorize Page</title>

    <link rel="stylesheet" href="css/auth.css">

    <script src="js/auth.js" defer></script>
</head>

<body>
    <header class="main-region">
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
                    <p>Welcome to Drip & Sip</p>
                    <span>Lorem ipsum inspiring people</span>
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
                        <button id="register-button" type="button" class="toggle-button" onclick="register()">REGISTER</button>
                        <button id="login-button" type="button" class="toggle-button" onclick="login()">LOGIN</button>
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
                                $reg_error = 'Enter a valid email';
                            }

                            if (trim($data['password']) < 4) {
                                $reg_error = 'Enter a correct password';
                            }

                            if (strlen($reg_error) == 0) {
                                $username = trim($data['username']);
                                $name = trim($data['name']);
                                $email = trim($data['email']);
                                $password = trim($data['password']);

                                $request = "SELECT * FROM clients WHERE username = '{$username}' or name = '{$email}'";
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
                                            $reg_error = 'Some error occured when fetching user';
                                        }
                                    } else {
                                        $reg_error = 'Some error occured when fetching database';
                                    }
                                } else {
                                    $reg_error = 'User already exists';
                                }                                
                            }
                        }

                        function login($data) {
                            global $server_connection;
                            global $log_error;

                            $username = trim($data['username']);
                            $password = trim($data['password']);
                            
                            if ($username == 'admin' && $password == 'admin') {
                                $_POST = array();
                                header('Location: admin/admin_panel.php');
                                die;
                            }

                            $request = "SELECT * FROM clients WHERE username = '{$username}';";
                            $query = mysqli_query($server_connection, $request);

                            $user = mysqli_fetch_array($query);

                            if ($user) {
                                $user_password = $user['password'];

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
                                    $log_error = 'Wrong password';
                                }
                            } else {
                                $log_error = 'User does not exist';
                            }
                        }
                    ?>

                        <div class="forms-region">
                            <form method="POST" id="register" class="input-group">
                                <input type="text" name="username" class="input-field" placeholder="Username" minlength="3" required value=''>
                                <input type="text" name="name" class="input-field" placeholder="Name" minlength="3" required>
                                <input type="email" name="email" class="input-field" placeholder="E-mail" required>
                                <input type="password" name="password" class="input-field" placeholder="Password" minlength="4" required><br>

                                <button type="submit" class="submit-button">SIGN UP</button>

                                <?php
                                echo "
                                    <span align='center' class='error'>$reg_error</span>
                                ";
                            ?>
                            </form>

                            <form method="POST" id="login" class="input-group">
                                <input type="text" name="username" class="input-field" placeholder="Username" minlength="3" required>
                                <input type="password" name="password" class="input-field" placeholder="Password" minlength="4" required><br>

                                <button type="submit" class="submit-button">LOGIN</button>

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
    </header>
</body>

</html>